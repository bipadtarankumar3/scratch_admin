<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Camping;
use Illuminate\Support\Facades\Auth;
use PDF;

class CampingController extends Controller
{
    public function camping_list(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(campings.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(campings.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['camping'] = Camping::where('created_by',Auth::user()->id)->whereRaw($where)->get();
            // dd($user);
            return view('user.camping.list',$array);
        }
    }
    public function expired_camping_list(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(campings.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(campings.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $presentDate = date('Y-m-d');

            $array['camping'] = Camping::select('campings.*','users.name as user_name')
            ->leftJoin('users','users.id','campings.id')
            ->whereDate('end_date','<',$presentDate)
            ->whereRaw($where)
            ->get();
            // dd($user);
            return view('user.camping.expired_camping_list',$array);
        }
    }

    public function add_camping_page(){

        if(Auth::check()){
            return view('user.camping.create');
        }
    }

    
    public function downloadCampaignPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {
                $array['camping'] = Camping::whereIn('id',$id )->where('created_by',Auth::user()->id)->get();
            $pdf = PDF::loadView('user.camping.campingPdf', $array);
        
            return $pdf->download('campaign.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function add_camping(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                Camping::where('id',$request->id)->update([
                    'campaign_name' => $request->campaign_name,
                    'title' => $request->title,
                    'title_status' => $request->title_status,
                    'sub_title' => $request->sub_title,
                    'sub_title_status' => $request->sub_title_status,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'validity_status' => $request->validity_status,
                    // 'total_form' => $request->total_form,
                    'spinner_time' => $request->spinner_time,
                    'number_of_total_spinn' => $request->number_of_total_spinn,
                    'created_by' => Auth::user()->id,
                    'status' => $request->status
                ]); 

                $camping = Camping::where('id',$request->id)->first();

                if ($camping) {

                    if (strtotime($request->end_date) > strtotime($camping->end_date)) {
                        Camping::where('id',$request->id)->update(['mail_send'=>'NO']); 
                    }
                    
                }

                
                $notification = array(
                    'messege'=>'Campaign Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {


                Camping::create([
                    'campaign_name' => $request->campaign_name,
                    'title' => $request->title,
                    'title_status' => $request->title_status,
                    'sub_title' => $request->sub_title,
                    'sub_title_status' => $request->sub_title_status,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'validity_status' => $request->validity_status,
                    // 'total_form' => $request->total_form,
                    'spinner_time' => $request->spinner_time,
                    'number_of_total_spinn' => $request->number_of_total_spinn,
                    'created_by' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $notification = array(
                    'messege'=>'Campaign inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }

    
    public function edit_camping($id){

        if(Auth::check()){
            $camping = Camping::where('id',$id)->first();
            // dd($camping);
            return view('user.camping.create',compact('camping','id'));
        }
    }

    public function delete_camping($id){

        if(Auth::check()){
            
            $camping = Camping::where('id',$id)->delete();

            $notification = array(
                'messege'=>'Campaign Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }
}
