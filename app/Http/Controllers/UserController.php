<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Camping;
use App\Models\Spinner;
use App\Models\SpinnerForm;
use App\Models\ip_skip;
use App\Models\SpinnerFormAccess;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;

use Config;
use Mail;
use App\Mail\adminForgotPassMail;
use App\Mail\OtpVerifyMail;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;



class UserController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function login_post(Request $request)
    {

        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make(123456)
        // ]);return;

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->type == 'admin') {
                $otp_number = 123456;
                //$otp_number = mt_rand(100000, 999999);
                $admin=DB::table('users')->where('email',Auth::user()->email)->update(['otp'=>$otp_number]);
    
                 $mail=DB::table('mail_configures')->first();
                 $config = array(
                    'driver' => 'smtp',
                    'host' => $mail->mail_host,
                    'port' => $mail->mail_port,
                    'from' => array('address' => $mail->mail_from_address, 'name' => $mail->mail_from_name),
                    'encryption' => $mail->mail_encryption,
                    'username' => $mail->mail_username,
                    'password' => $mail->mail_password,
                    'sendmail' => '/usr/sbin/sendmail -bs',
                    'pretend' => false,
                    'stream' => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ],
                    ],
                );
                Config::set('mail',$config);
                $type="ADMIN";
                $user= Mail::to(Auth::user()->email)->send(new OtpVerifyMail($type,$otp_number));
                session()->put('admin_id', Auth::user()->id);
                session()->put('otp', $otp_number);
                return redirect('otp_verify_page');
            } else {
                return redirect('admin/dashboard');
            }
            

            
        }
  
        $notification = array(
            'messege'=>'Login details are Invalid',
            'alert-type'=>'error'
        );
        return back()->with($notification);
    }

    public function otp_verify_page(){

        $admin_id = session()->get('admin_id');

        if ($admin_id) {
            return view('admin.otp_verify');
        } else {
            return redirect('admin');
        }
        
    }

    
    //admin Password Check
    public function otp_verify(Request $request){

        $admin_id = session()->get('admin_id');
        $otp = session()->get('otp');
        $get_otp = $request->otp;
    
        if ($otp == $get_otp) {

            $admin=User::where('id',$admin_id)->first();

            if ($admin->type == 'admin' ) {

                $six_digit_random_number = random_int(100000, 999999);

                
                $UserUpdate=User::where('id',$admin_id)->update(['otp_link_status'=>'yes']);

                $adminId=$admin->id;
                $request->session()->put('adminId', $adminId);
                session()->put('adminUserId', $admin->id);
                session()->put('type', $admin->type);
                session()->put('adminName', $admin->name);
                return redirect('admin/dashboard');
            } else {
                if ($admin->admin_status == '1') {
                    $subAdmin=Admin_permission::where('admin_permission_admin_id',$admin->id)->first();
                    $adminPermission = explode(',', $subAdmin->admin_permission_details);

                    //print_r($adminPermission);
                    for ($i=0; $i <count($adminPermission) ; $i++) {
                        $per =  $adminPermission[$i];
                        session()->put($per, $adminPermission[$i]);
                    }
                    $adminId=$admin->id;
                    $request->session()->put('adminId', $adminId);
                    session()->put('adminUserId', $admin->email);
                    session()->put('type', $admin->type);
                    session()->put('adminName', $admin->name);
                    //echo Session::get('ProductList'); die;
                    return redirect('admin/dashboard');
                } else {
                    $request->session()->flash('adminDeactive', 'adminDeactive');
                    return back();
                }

            }
        } else {
            $request->session()->flash('otp_error', 'otp_error');
            return redirect('otp_verify_page');
        }

     
    }


    public function dashboard()
    {
        if(Auth::check()){

            $today = date('Y-m-d');

            $Users = User::where('type','user')->count();
            $ActiveUsers = User::where('type','user')->where('status','active')->count();
            $InactiveUsers = User::where('type','user')->where('status','inactive')->count();
            $ExpiredUser = User::where('type','user')->whereDate('expiry_date','<',$today)->count();
            $Camping = Camping::where('created_by',Auth::user()->id)->count();
            $CampingList = Camping::where('created_by',Auth::user()->id)->select('id')->get()->toArray();
            $Spinner = Spinner::where('created_by',Auth::user()->id)->count();
            //dd($CampingList);
            $camp_id =[];
            foreach ($CampingList as $key => $value) {
                $camp_id[] =$value['id'];
            }
            $SpinnerForm = SpinnerForm::where('camping_id',$camp_id)->count();

            return view('admin.dashboard',compact('Users','Camping','SpinnerForm','ActiveUsers','InactiveUsers','ExpiredUser','Spinner'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    


    public function logout(){

        Session::flush();
      // $class=DB::table('class')->get();
       return redirect('/login');
    }


    public function sub_user_list(Request $request){

        if(Auth::check() && Auth::user()->type == 'admin'){


            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(users.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(users.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['user'] = User::where('type','user')->whereRaw($where)->orderBy('id','desc')->get();
            // dd($user);
            return view('admin.user.list',$array);
        }else{
            return redirect('/');
        }
    }

    public function expiry_sub_user(Request $request){

        if(Auth::check()){

            $date = date('Y-m-d');

            $array['user'] = User::where('type','user')->whereDate('expiry_date','<=',$date)->get();
            // dd($user);
            return view('admin.user.expiry_user_list',$array);
        }
    }

    public function add_sub_user_page(){

        if(Auth::check()){
            return view('admin.user.create');
        }
    }

    public function downloadUserPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $user_id = $request->checkbox;
            if ($user_id != null) {
                $array['user'] = User::whereIn('id',$user_id )->get();
            $pdf = PDF::loadView('admin.user.userPdf', $array);
        
            return $pdf->download('user.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function user_name_checking(Request $request){

        //dd($request->all());

        $user = User::where('name_url',$request->name)->first();
        if ($user) {
            $user_status = 'exist';
        } else {
            $user_status = 'not_exist';
        }
        return $user_status;
    }

    public function add_sub_user(Request $request){

        if(Auth::check()){

            $name_url = str_replace(' ', '_',$request->name_url);
            $nameurl = strtolower($name_url);
            
            if ($request->id !='') {
                

                $user = User::find($request->id);

                if ($request->password != '' && $request->old_password != '') {
                    if(!Hash::check($request->old_password, $user->password)){
                        $notification = array(
                            'messege'=>'Old Password is not matching',
                            'alert-type'=>'error'
                        );
                        return back()->with($notification);
                    }else{
                        $user->password = Hash::make($request->password);
                    }
                    
                }

                if ($request->customer_password == 'changed') {
                    if(!empty($request->password)){
                        $user->password = Hash::make($request->password);
                    }
                }

                $user->name = $request->name;
                $user->name_url = $request->name_url;
                $user->email = $request->email;
                
                $user->phone = $request->phone;
                if ($request->status != '') {
                    $user->status = $request->status;
                }
                if ($request->expiry_date != '') {
                    $user->expiry_date = $request->expiry_date;
                }
                if ($request->spin_whell_round != '') {
                    $user->spin_whell_round = $request->spin_whell_round;
                }
                if ($request->note != '') {
                    $user->note = $request->note;
                }
                if ($request->background_color != '') {
                    $user->background_color = $request->background_color;
                }


                if ($request->default_background != '') {
                    $user->default_background = $request->default_background;
                }else{
                    $user->default_background = '';
                }

                if ($request->default_spinn != '') {
                    $user->default_spinn = $request->default_spinn;
                }


                if ($request->wp_key != '') {
                    $user->wp_key = $request->wp_key;
                }
                
                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->logo = $document_link;
                    }

                }
                
                if (isset($request->background_image) && !empty($request->background_image)) {
                    if ($request->hasFile('background_image')) {
                        $file = $request->file('background_image');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->background_image = $document_link;
                    }

                }
                
                $user->save();

                
                $notification = array(
                    'messege'=>'User Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {

                $user = User::where('email',$request->email)->first();

                if ($user) {
                    $notification = array(
                        'messege'=>'Please enter unique email',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }

                $document_link  ='';

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        
                    }
                }

                User::create([
                    'user_unique_id' => Str::random(10),
                    'name' => $request->name,
                    'name_url' => $nameurl,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'type' => 'user',
                    'status' => $request->status,
                    'expiry_date' => $request->expiry_date,
                    'spin_whell_round' => $request->spin_whell_round,
                    'default_background' => 'on',
                    'note' => $request->note,
                    'wp_key' => $request->wp_key,
                    'logo' => $document_link
                ]);

                $notification = array(
                    'messege'=>'User inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }

    
    public function edit_sub_user($id){

        if(Auth::check()){
            $user = User::where('id',$id)->first();
            return view('admin.user.create',compact('user','id'));
        }
    }
    
    public function profile(){

        if(Auth::check()){

            $id = Auth::user()->id;

            $user = User::where('id',$id)->first();
            return view('admin.user.profile',compact('user','id'));
        }
    }
    
    public function profile_update(Request $request){

        if(Auth::check()){
            
            $id = Auth::user()->id;
 
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != '') {
                $user->password = $request->password;
            }
            $user->phone = $request->phone;
            $user->note = $request->note;
            if (isset($request->file) && !empty($request->file)) {
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $name = time() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('upload/');
                    $file->move($destinationPath, $name);

                    $document_link =  URL('upload/'.$name);
                    $user->logo = $document_link;
                }

            }
            
            $user->save();

            
            $notification = array(
                'messege'=>'User Updated successfully',
                'alert-type'=>'success'
            );
            return back()->with($notification);

        }
    }

    public function delete_sub_user($id){

        if(Auth::check()){
            
            $user = User::where('id',$id)->delete();

            $notification = array(
                'messege'=>'User Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }


        //Admin Forgot Password
        public function forgotPassword(){

            //echo "di";die;
    
            return view('admin.forgotPassword.forgotPassword');
         }
    
         //admin UserId Check
         public function adminUserIdCheck(Request $request){
             $userName = $request->email;
             $admin=DB::table('users')->where('email',$request->email)->first();
             if ($admin) {
                 //echo "dd";
                 //print_r($admin);
                 $adminKey = $admin->user_unique_id;
                 $adminMail = $admin->email;
                 $subject='Admin Forgot Password';
                 //$message='Thank You For Contact Us';
                 $admin=DB::table('users')->where('email',$request->email)->update(['user_email_status'=>'urlAvailable']);
    
                 $mail=DB::table('mail_configures')->first();
                 $config = array(
                    'driver' => 'smtp',
                    'host' => $mail->mail_host,
                    'port' => $mail->mail_port,
                    'from' => array('address' => $mail->mail_from_address, 'name' => $mail->mail_from_name),
                    'encryption' => $mail->mail_encryption,
                    'username' => $mail->mail_username,
                    'password' => $mail->mail_password,
                    'sendmail' => '/usr/sbin/sendmail -bs',
                    'pretend' => false,
                    'stream' => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ],
                    ],
                );
                Config::set('mail',$config);
                $type="ADMIN";
                 $user= Mail::to($adminMail)->send(new adminForgotPassMail($type,$adminKey,$subject));
                 $request->session()->flash('checkYourMail', 'checkYourMail');
                 $notification = array(
                            'messege'=>'Check Your Email',
                            'alert-type'=>'success'
                        );
                        return back()->with($notification);
                 //return view('admin.forgotPassword.forgotConfirmPassword',compact('userName'));
    
             } else {
                $notification = array(
                    'messege'=>'User Id Not Maching',
                    'alert-type'=>'error'
                );
                return back()->with($notification);
             }
         }
    
         //admin Password Check
         public function confirmPasswordPage($adminKey){
             $admin=DB::table('users')
             ->where('user_unique_id',$adminKey)
             ->first();
             $adminStatus='';
             if ( $admin) {
                 if ($admin->user_email_status == 'urlAvailable') {
                     $adminStatus= "urlAvailable";
                 } else {
                     $adminStatus= "urlNotAvailable";
                 }
             }else{
                 $adminStatus= "adminNotAvailable";
             }
             //echo $adminStatus;
             $adminKey = $adminKey;
             return view('admin.forgotPassword.forgotConfirmPassword',compact('adminKey','adminStatus'));
         }
    
         //admin Password Check
         public function confirmPassword(Request $request){
             $password = $request->password;
             $confirmPassword = $request->confirmPassword;
    
             if ( $password  == $confirmPassword) {
                 $adminUp=DB::table('users')->where('user_unique_id',$request->adminKey)->update(['password'=>Hash::make($password),'user_email_status'=>'urlNotAvailable']);
                 $admin=User::where('user_unique_id',$request->adminKey)->first();
                    $credentials = [
                        'email' => $admin->email,
                        'password' =>$password,
                    ];

                        if (Auth::attempt($credentials)) {
                            return redirect('admin/dashboard');
                        }
             } else {
                
                 $notification = array(
                    'messege'=>'Password Not Match',
                    'alert-type'=>'error'
                );
                return back()->with($notification);
             }
         }



    //---------------------------------- Skip Ip ------------------------------------

    public function ip_skip(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(ip_skips.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(ip_skips.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['ip_skip'] = ip_skip::where('user_id',Auth::user()->id)->whereRaw($where)->get();
            // dd($user);
            return view('user.ip_skip.list',$array);
        }
    }

    public function add_ip_skip_page(){

        if(Auth::check()){
            return view('user.ip_skip.create');
        }
    }

    
    public function downloadip_skipPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {
                $array['ip_skip'] = ip_skip::whereIn('id',$id )->get();
            $pdf = PDF::loadView('user.ip_skip.ip_skipPdf', $array);
        
            return $pdf->download('ip_skip.pdf');
            } else {
                return back();
            }
                 
        }
    }

    public function add_ip_skip(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                ip_skip::where('id',$request->id)->update([
                    'ip' => $request->ip,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]); 

                
                $notification = array(
                    'messege'=>'IP skip Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {


                ip_skip::create([
                    'ip' => $request->ip,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $notification = array(
                    'messege'=>'IP skip Added Successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }

    
    public function edit_ip_skip($id){

        if(Auth::check()){
            $ip_skip = ip_skip::where('id',$id)->first();
            return view('user.ip_skip.create',compact('ip_skip','id'));
        }
    }

    public function delete_ip_skip($id){

        if(Auth::check()){
            
            $ip_skip = ip_skip::where('id',$id)->delete();

            $notification = array(
                'messege'=>'IP skip Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

    public function dashboard_visit($id){

        if(Auth::check()){
            
            $user = User::where('id',$id)->first();
            Auth::login($user);

            return redirect('admin/dashboard');
            
        }
    }

    //---------------------------------- Skip Ip ------------------------------------



    
    public function view_qr(Request $request){

        if(Auth::check()){
            
 
            return view('admin/view_qr');
            
        }
    }

    public function print_qr_code(Request $request){

        if(Auth::check()){

            return view('admin/print_qr_code');
            
        }
    }
    public function showQRCode(Request $request){

      // Generate a simple QR code with the given data
      $qrCode = QrCode::format('png')->size(300)->generate('Your QR Code Data');

      // Return the image as a response
      return response($qrCode)->header('Content-Type', 'image/png');
  

    }

    public function generatePDF()
    {
            
        $pdf = PDF::loadView('admin.my_qr_code');
        
        return $pdf->download('MyQRCode.pdf');
    }
    public function spin_pi_clear(Request $request)
    {
        if ($request->delete_conformation == 'Delete') {
            // Fetch all Camping records created by the authenticated user
            $CampingRecords = Camping::where('created_by', Auth::user()->id)->get(); // Use `get()` instead of `all()`

            if ($CampingRecords->isNotEmpty()) {
                // Loop through each camping record and delete related SpinnerFormAccess entries
                foreach ($CampingRecords as $Camping) {
                    SpinnerFormAccess::where('campaign_id', $Camping->id)->delete();
                }

                $notification = array(
                    'messege' => 'Deleted successfully',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            } else {
                $notification = array(
                    'messege' => 'No campaign found',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        } else {
            $notification = array(
                'messege' => 'Please type Delete',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }


    public function change_spin_mode(Request $request){
  
        if(Auth::check()){
            
            $id = Auth::user()->id;
 
            $user = User::find($id);

            if ($request->spin_mode == 'on') {
                $user->default_spinn = '2';
            } else {
                $user->default_spinn = '1';
            }
            
            $user->save();

            
            $notification = array(
                'messege'=>'Spin Mode Updated successfully',
                'alert-type'=>'success'
            );
            return back()->with($notification);

        }
    }

}
