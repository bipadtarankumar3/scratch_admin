<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\BikeModel;
use Illuminate\Support\Facades\Auth;
use PDF;

class BikeModelController extends Controller
{
    public function bike_model(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(bike_models.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(bike_models.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['bike'] = BikeModel::where('created_by',Auth::user()->id)->whereRaw($where)->get();
            // dd($user);
            return view('user.bike.list',$array);
        }
    }

    public function add_bike_page(){

        if(Auth::check()){
            return view('user.bike.create');
        }
    }

    
    public function downloadBikePdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {
                $array['bike'] = BikeModel::whereIn('id',$id )->get();
            $pdf = PDF::loadView('user.bike.bikePdf', $array);
        
            return $pdf->download('bike.pdf');
            } else {
                return back();
            }
                 
        }
    }

    public function add_bike(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                BikeModel::where('id',$request->id)->update([
                    'name' => $request->name,
                    'created_by' => Auth::user()->id,
                    'status' => $request->status
                ]); 

                
                $notification = array(
                    'messege'=>'Bike Model Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {


                BikeModel::create([
                    'name' => $request->name,
                    'created_by' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $notification = array(
                    'messege'=>'Bike Model Added Successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }

    
    public function edit_bike($id){

        if(Auth::check()){
            $bike = BikeModel::where('id',$id)->first();
            return view('user.bike.create',compact('bike','id'));
        }
    }

    public function delete_bike($id){

        if(Auth::check()){
            
            $bike = BikeModel::where('id',$id)->delete();

            $notification = array(
                'messege'=>'Bike Model Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }
}
