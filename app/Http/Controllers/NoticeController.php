<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Camping;
use App\Models\notice;
use Illuminate\Support\Facades\Auth;
use PDF;

class NoticeController extends Controller
{
    public function notice(Request $request){

        if(Auth::check()){

            
            $array['notice'] = notice::where('user_id',Auth::user()->id)->first();
            // dd($user);
            return view('admin.notice.notice',$array);
        }
    }

    public function add_notice(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                notice::where('id',$request->id)->update([
                    'notice' => $request->notice,
                    'status' => $request->status
                ]); 

                
                $notification = array(
                    'messege'=>'Notice Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {


                notice::create([
                    'notice' => $request->notice,
                    'status' => $request->status,
                    'user_id' => Auth::user()->id
                ]);

                $notification = array(
                    'messege'=>'Notice inserted successfully',
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
