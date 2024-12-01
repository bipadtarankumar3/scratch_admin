<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Spinner;
use App\Models\SpinnerForm;
use App\Models\Camping;
use App\Models\User;
use App\Models\BikeModel;
use App\Models\SpinnerFormAccess;
use App\Models\FormFields;
use App\Models\sitesetting;
use DB;
use Config;
use Mail;
use App\Mail\SpinnerFormMail;
use App\Models\ip_skip;

use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index($user_name){

        $date = date('Y-m-d');
        $user = User::where('name_url',$user_name)->first();
        // $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT'].$_SERVER['REMOTE_ADDR'];
        // echo $computerId;die;

        if ($user) {

            $userUpdate = User::where('id',$user->id)->update(['total_visit'=>$user->total_visit+1]);

            $userDate = User::whereDate('expiry_date','>=',$date)->where('id',$user->id)->first();
            if ($userDate) {

                $today = date('Y-m-d');
                //dd($today );

                //$where = '1=1';
                //$where .= " and  date(campings.end_date) >= '$today'" ;
                $Camping = Camping::
                whereDate('end_date', '>=',$today)
                 ->whereDate('start_date', '<=', $today)
                 ->where('created_by', $user->id)
                ->where('status', 'active')
                ->where('total_form', '>=', 1)
                ->orderBy('id','desc')
                //->whereRaw($where)
                
                ->first();
                
                //dd( $Camping );
                if ($Camping) {
                    
                    $Spinner = Spinner::where('created_by', $user->id)->where('camping_id', $Camping->id)->where('status','active')->inRandomOrder()->get();
                    $spinner_data = [];
                    $spinner_skip_data = [];
                    foreach ($Spinner as $key => $value) {
                        $arr = array(
                            'id'=>encrypt($value->id),
                            'text'=>$value->name,
                            'color'=>$value->color,
                            'reaction'=>"shocked",
                            'price'=>$value->value,
                            'image'=>$value->image,
                        );
                        $spinner_data[] =  $arr ;
                        if ($value->skip == 'Yes') {
                            $spinner_skip_data[] =$value->name ;
                        }else{
                            if ($value->value == 0) {
                                $spinner_skip_data[] =$value->name ;
                            }
                        }
                        
                    }

                    $spinner_data_json = json_encode( $spinner_data );
                    $spinner_skip_json = json_encode( $spinner_skip_data );
                    $rotation_time = $Camping->spinner_time;

                    $BikeModel = BikeModel::where('created_by',$userDate->id)->get();
                    $FormFields = FormFields::where('user_id',$userDate->id)->first();

                    //print_r($spinner_skip_data);die;

                    $ip_address = request()->ip();
                    $campaign_id = $Camping->id;

                    
                    $ip_skip = ip_skip::where('ip',$ip_address)->where('user_id',$userDate->id)->first();
                    if ($ip_skip) {
                        $SpinnerFormAccessCount = 'NO_LIMIT';
                    } else {
                        $SpinnerFormAccessCount = SpinnerFormAccess::where('ip_address',$ip_address)->where('campaign_id',$campaign_id)->count();
                    }
                    
                    $sitesetting = sitesetting::first();
                    

                    return view('frontend.index',compact(
                        'spinner_data_json',
                        'spinner_skip_json',
                        'rotation_time',
                        'Camping',
                        'user',
                        'BikeModel',
                        'SpinnerFormAccessCount',
                        'FormFields',
                        'sitesetting'
                    ));
                } else {
                    $status= 'no_camping_available';
                    return view('frontend.404',compact('status','user'));
                }
            } else {
                $status= 'user_date_expired';
                return view('frontend.404',compact('status'));
            }
            
            
            

            
        } else {
            $status= 'no_user_available';
            return view('frontend.404',compact('status'));
        }
         
    }

    public function spinner_form(Request $request){
        DB::beginTransaction();
        try {
            
            $Spinner = Spinner::where('id',decrypt($request->spinner_id))->first();

            if ($Spinner) {

                $Camping = Camping::where('id',$Spinner->camping_id)->first();
                // dd($Spinner);
                if ($Camping && $Camping->total_form >= 1 ) {
                        $ip_address = request()->ip();

                    // $SpinnerMacAddr = SpinnerForm::where('mac_address',$ip_address)->first();
                    // if ($SpinnerMacAddr) {
                    //     $data = array(
                    //         'message'=>'AlreadyInserted',
                    //         'status'=>1,
                    //         'data'=>'',
                    //     );
                    //     return response()->json($data);
                    // }

                    $url='';
                    /*************document upload **********/
                        if($request->hasFile('screenshot')) {
                            $screenshot=$request->file('screenshot');
                            $milisecond=round(microtime(true)*1000);
                            $name=$screenshot->getClientOriginalName();
                            $actual_name=str_replace(" ","_",$name);
                            $uploadName=$milisecond."_".$actual_name;
                            $screenshot->move(public_path().'/upload/',$uploadName);
                            $url = asset('upload/'.$uploadName);
                    }
                    /***********document upload ************/
                    date_default_timezone_set("Asia/Calcutta"); 
                    $arr = array(
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'phone'=>$request->phone,
                        'whatsapp_number'=>$request->whatsapp_number,
                        'schreenshot'=>$url,
                        'spinner_id'=>$Spinner->id,
                        'camping_id'=>$Spinner->camping_id,
                        'bike_model_id'=>$request->bike_model_id,
                        'mac_address'=>$ip_address
                    );
                    SpinnerForm::create($arr);

                    $form_submitted = $Camping->form_submitted + 1;
                    $CampingUpdate = Camping::where('id',$Spinner->camping_id)->update(['form_submitted'=>$form_submitted]);

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
                    $subject="Spinner Form";
                    
                    $userDate = User::where('id',$Camping->created_by)->first();
                    if ($userDate) {
                        
                       
                        $SpinnerDetails = Spinner::where('id',decrypt($request->spinner_id))->first();
                        $mail_arr = array(
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'phone'=>$request->phone,
                            'whatsapp_number'=>$request->whatsapp_number,
                            'schreenshot'=>$url,
                            'spinner_id'=>$Spinner->id,
                            'spinner_name'=>($SpinnerDetails)? $SpinnerDetails->name:'',
                            'camping_id'=>$Spinner->camping_id,
                            'camping_name'=>$Camping->title,
                            'bike_model_id'=>$request->bike_model_id,
                            'ip_address'=>$ip_address
                        );
                        
                        // $string = ($SpinnerDetails)? $SpinnerDetails->name:'';
                        // $replaced = str_replace(' ', '%20', $string);
                        // $message = 'Congratulations,%20'.$request->name.'%20You%20have%20won%20the%20'.$replaced.',%20Our%20team%20will%20contact%20you%20soon.%20If%20have%20you%20any%20Query,%20Please%20reply%20Hello';
                        
                        // $curl = curl_init();
                            
                        // curl_setopt_array($curl, array(
                        //   CURLOPT_URL => 'http://api.vyyapar.com/wapp/api/send?apikey=717507ca60484e13add12d4364826225&mobile='.$userDate->phone.'&msg=testmsg%20oo',
                        //   CURLOPT_RETURNTRANSFER => true,
                        //   CURLOPT_ENCODING => '',
                        //   CURLOPT_MAXREDIRS => 10,
                        //   CURLOPT_TIMEOUT => 0,
                        //   CURLOPT_FOLLOWLOCATION => true,
                        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        //   CURLOPT_CUSTOMREQUEST => 'GET',
                        // ));
                        
                        // $response = curl_exec($curl);
                        
                        // curl_close($curl);
                        
                        if(!empty($request->phone) && $userDate->wp_key !=''){
                            $curl = curl_init();
                            
                            $string = ($SpinnerDetails)? $SpinnerDetails->name:'';
                            $replaced = str_replace(' ', '%20', $string);
                            $message = 'Congratulations,%20'.$request->name.'%20You%20have%20won%20the%20'.$replaced.',%20Our%20team%20will%20contact%20you%20soon.%20If%20have%20you%20any%20Query,%20Please%20reply%20Hello';
                        
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => 'http://api.vyyapar.com/wapp/api/send?apikey='.$userDate->wp_key.'&mobile='.$request->phone.'&msg='.$message,
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'GET',
                            ));
                            
                            $response = curl_exec($curl);
                            
                            curl_close($curl);

                            if($userDate->wp_count == ''){
                                $count =1;
                            }else{
                                $count = $userDate->wp_count+1;
                            }

                            $userDateUp = User::where('id',$userDate->id)->update(['wp_count'=>$count]);

                        }
                        
                            


                        $admin= Mail::to($userDate->email)->send(new SpinnerFormMail($type,$mail_arr,$subject));

                        // if ($request->email !='') {
                        //     $user= Mail::to($request->email)->send(new SpinnerFormMail('CUSTOMER',$mail_arr,$subject));
                        // }

                        
                    }
                    
                    DB::commit();

                    $data = array(
                        'message'=>'Inserted',
                        'status'=>1,
                        'data'=>'',
                    );
                    return response()->json($data);
                } else {
                    DB::rollback();
                    $data = array(
                        'message'=>'Error',
                        'status'=>0,
                        'data'=>'',
                    );
                    return response()->json($data);
                }
                
            } else {
                DB::rollback();
                $data = array(
                    'message'=>'Not Getting The Spinner',
                    'status'=>0,
                    'data'=>'',
                );
                return response()->json($data);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $data = array(
                'message'=>'Code Error',
                'status'=>0,
                'data'=>'',
            );
            return response()->json($data);
        } 
    }
    
    public function dummy(){

        return view('frontend.dummy');
        
    }
    
    public function spinner_form_check(Request $request){

        $ip_address = request()->ip();

        $SpinnerMacAddr = SpinnerForm::where('mac_address',$ip_address)->first();
        if ($SpinnerMacAddr) {
            $data = array(
                'message'=>'AlreadyInserted',
                'status'=>1,
                'data'=>'',
            );
            return response()->json($data);
        }
        
    }
    
    public function spinner_value_check(Request $request){


        try {
            $spinner_id = decrypt($request->spinner_id);
            $Spinner = Spinner::where('id',$spinner_id)->first();
            if ($Spinner && $Spinner->value >= 1) {

                $SpinnerUpdate = Spinner::where('id',$spinner_id)->update(['value'=>$Spinner->value-1]);
                $Camping = Camping::where('id',$Spinner->camping_id)->first();
                if ($Camping) {
                    $total_form = $Camping->total_form - 1;
                    $CampingUpdate = Camping::where('id',$Spinner->camping_id)->update(['total_form'=>$total_form]);
                    $userDate = User::where('id',$Camping->created_by)->first();
                    if ($userDate) {
                        $userUpdate = User::where('id',$Camping->created_by)->update(['total_spin_round'=>$userDate->total_spin_round + 1]);

                    }
                   
                }

               
    
                $data = array(
                    'message'=>'updated',
                    'status'=>true,
                    'data'=>''
                );
                return response()->json($data);
            }else{
                $data = array(
                    'message'=>'There Is No Offer',
                    'status'=>false,
                    'data'=>''
                );
                return response()->json($data);
            }
        } catch (\Throwable $th) {
            $data = array(
                'message'=>'Id Error',
                'status'=>false,
                'data'=>'',
            );
            return response()->json($data);
        }

        
        
    }
    
    public function spinner_round_check(Request $request){

        $ip_address = request()->ip();
        $campaign_id = $request->campaign_id;
        $user_id = $request->user_id;

        $user = User::where('id',$user_id)->first();

        
        $ip_skip = ip_skip::where('ip',$ip_address)->where('user_id',$user->id)->first();

        if ($ip_skip) {
            $data = array(
                'message'=>'NotInserted',
                'status'=>true,
                'data'=>'',
                'total_count'=>'No Limit'
            );
            return response()->json($data);
        } else {

            

            $SpinnerFormAccess = SpinnerFormAccess::where('ip_address',$ip_address)->where('campaign_id',$campaign_id)->count();
            $total_count =  $user->spin_whell_round -$SpinnerFormAccess ;

            $SpinnerMacAddr = SpinnerForm::where('mac_address',$ip_address)->where('camping_id',$campaign_id)->first();
            if ($SpinnerMacAddr) {
                $data = array(
                    'message'=>'You have already submitted details',
                    'status'=>false,
                    'data'=>'',
                    'total_count'=>$total_count
                );
                return response()->json($data);
            }

            if ($SpinnerFormAccess >= $user->spin_whell_round) {
                $data = array(
                    'message'=>'You have no limit for spin',
                    'status'=>false,
                    'data'=>'',
                    'total_count'=>$total_count
                );
                return response()->json($data);
            }else{

                $SpinnerFormAccess = SpinnerFormAccess::create(['ip_address'=>$ip_address,'campaign_id'=>$campaign_id]);

                $SpinnerFormAccessCount = SpinnerFormAccess::where('ip_address',$ip_address)->where('campaign_id',$campaign_id)->count();
                $total_count =  $user->spin_whell_round -$SpinnerFormAccessCount ;
                $data = array(
                    'message'=>'NotInserted',
                    'status'=>true,
                    'data'=>'',
                    'total_count'=>$total_count
                );
                return response()->json($data);
            }
        }
        


        
        
    }
}
