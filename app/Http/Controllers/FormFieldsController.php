<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\FormFields;
use Illuminate\Support\Facades\Auth;
use PDF;

class FormFieldsController extends Controller
{
    public function form_access(Request $request){

        if(Auth::check()){
            $array['FormFields'] = FormFields::where('user_id',Auth::user()->id)->first();
            // dd($user);
            return view('user.form_access.form_access',$array);
        }
    }

    public function form_access_post(Request $request){

        if(Auth::check()){
            
            if ($request->id !='') {

                FormFields::where('id',$request->id)->update([
                    // 'name' => $request->name,
                    // 'number' => $request->number,
                    'whatsapp_no' => $request->whatsapp_no,
                    'email' => $request->email,
                    'address' => $request->address,
                    'choose_option' => $request->choose_option,
                    'screenshot' => $request->screenshot,
                    'screenshot_required' => $request->screenshot_required,
                ]); 

                
                $notification = array(
                    'messege'=>'Form Fields Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {


                FormFields::create([
                    // 'name' => $request->name,
                    // 'number' => $request->number,
                    'whatsapp_no' => $request->whatsapp_no,
                    'email' => $request->email,
                    'address' => $request->address,
                    'choose_option' => $request->choose_option,
                    'user_id' => Auth::user()->id,
                    'screenshot' => $request->screenshot,
                    'screenshot_required' => $request->screenshot_required,
                ]);

                $notification = array(
                    'messege'=>'Form Fields Added Successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }
}
