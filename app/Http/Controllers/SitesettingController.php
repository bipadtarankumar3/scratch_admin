<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Camping;
use App\Models\sitesetting;
use Illuminate\Support\Facades\Auth;
use PDF;


class SitesettingController extends Controller
{
    public function sitesetting(Request $request){

        if(Auth::check()){

            
            $array['sitesetting'] = sitesetting::where('user_id',Auth::user()->id)->first();
            // dd($user);
            return view('admin.sitesetting.sitesetting',$array);
        }
    }

    public function add_sitesetting(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);

                        sitesetting::where('id',$request->id)->update([
                            'background_music' => $document_link,
                            'user_id' => Auth::user()->id,
                            'background_music_status' => $request->status
                        ]); 
                        
                    }
                }else{
                    sitesetting::where('id',$request->id)->update([
                        'user_id' => Auth::user()->id,
                        'background_music_status' => $request->status
                    ]); 
                }

                
                $notification = array(
                    'messege'=>'sitesetting Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {


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

                sitesetting::create([
                    'background_music' => $document_link,
                    'background_music_status' => $request->status,
                    'user_id' => Auth::user()->id
                ]);

                $notification = array(
                    'messege'=>'sitesetting inserted successfully',
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
