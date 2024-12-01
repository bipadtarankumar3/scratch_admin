<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Camping;
use App\Models\popupalert;
use Illuminate\Support\Facades\Auth;
use PDF;

class PopupalertController extends Controller
{
    public function popup_alert(Request $request){

        if(Auth::check()){

            
            $array['popupalert'] = popupalert::where('user_id',Auth::user()->id)->first();
            // dd($user);
            return view('admin.popup_alert.popup_alert',$array);
        }
    }

    public function add_popup_alert(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {
                
                $popupalert = popupalert::find($request->id);
                
                if (isset($request->popup_img) && !empty($request->popup_img)) {
                    if ($request->hasFile('popup_img')) {
                        $file = $request->file('popup_img');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $popupalert->popup_img = $document_link;
                    }

                }
                $popupalert->title = $request->title;
                $popupalert->status = $request->status;
                $popupalert->save();

                
                $notification = array(
                    'messege'=>'popupalert Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {

                $document_link='';
                if (isset($request->popup_img) && !empty($request->popup_img)) {
                    if ($request->hasFile('popup_img')) {
                        $file = $request->file('popup_img');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                    }

                }

                popupalert::create([
                    'title' => $request->title,
                    'popup_img' => $document_link,
                    'status' => $request->status,
                    'user_id' =>Auth::user()->id,
                    'user_type' =>Auth::user()->type
                ]);

                $notification = array(
                    'messege'=>'popupalert inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }
}
