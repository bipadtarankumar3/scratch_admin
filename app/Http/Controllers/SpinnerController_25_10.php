<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Spinner;
use App\Models\SpinnerForm;
use App\Models\BikeModel;
use App\Models\Camping;
use Illuminate\Support\Facades\Auth;

use Response;
use PDF;

class SpinnerController extends Controller
{
    
    public function spinner_list(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(spinners.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(spinners.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['Spinner'] = Spinner::select('spinners.*','campings.campaign_name as c_name','campings.title as c_title')
            ->leftJoin('campings','campings.id','spinners.camping_id')
            ->where('spinners.created_by',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.spinner.list',$array);
        }
    }

    
    
    public function downloadSpinnerPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {

                $array['Spinner'] = Spinner::select('spinners.*','campings.campaign_name as c_name','campings.title as c_title')
                    ->leftJoin('campings','campings.id','spinners.camping_id')
                    ->whereIn('spinners.id',$id )
                    ->where('spinners.created_by',Auth::user()->id)
                    ->get();
                $pdf = PDF::loadView('user.spinner.spinnerPdf', $array);
        
            return $pdf->download('spinner.pdf');
            } else {
                return back();
            }
                  
        }
    }


    public function add_spinner_page(){

        if(Auth::check()){
            $camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.spinner.create',compact('camping'));
        }
    }

    public function spinner_form(){

        if(Auth::check()){
            $camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.spinner.form',compact('camping'));
        }
    }

    public function add_spinner(Request $request){

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

                        Spinner::where('id',$request->id)->update([
                            'name' => $request->name,
                            'image' => $document_link,
                            'value' => $request->value,
                            'color' => $request->color,
                            'skip' => $request->skip,
                            'camping_id' => $request->camping_id,
                            'created_by' => Auth::user()->id,
                            'status' => $request->status
                        ]); 
                        
                    }
                }else{
                    Spinner::where('id',$request->id)->update([
                        'name' => $request->name,
                        'value' => $request->value,
                        'color' => $request->color,
                        'skip' => $request->skip,
                        'camping_id' => $request->camping_id,
                        'created_by' => Auth::user()->id,
                        'status' => $request->status
                    ]); 
                }
                $TotalSpinner = Spinner::where('camping_id',$request->camping_id)->sum('value');
                $CampingUpdate = Camping::where('id',$request->camping_id)->update(['total_form'=>$TotalSpinner]);

                $notification = array(
                    'messege'=>'Spinner Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);
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

                Spinner::create([
                    'name' => $request->name,
                    'image' => $document_link,
                    'value' => $request->value,
                    'color' => $request->color,
                    'skip' => $request->skip,
                    'camping_id' => $request->camping_id,
                    'created_by' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $TotalSpinner = Spinner::where('camping_id',$request->camping_id)->sum('value');
                $CampingUpdate = Camping::where('id',$request->camping_id)->update(['total_form'=>$TotalSpinner]);

                $notification = array(
                    'messege'=>'Spinner inserted successfully',
                    'alert-type'=>'success'
                );
                return Response::json($notification);

            }
            


        }
    }

    
    public function edit_spinner($id){

        if(Auth::check()){
            $Spinner = Spinner::where('id',$id)->first();
            $camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.spinner.form',compact('Spinner','id','camping'));
        }
    }

    public function delete_spinner($id){

        if(Auth::check()){
            
            $Spinner = Spinner::where('id',$id)->delete();

            $notification = array(
                'messege'=>'Spinner Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }



    // Spinner form ------------------------
    public function spinner_form_camping_list(Request $request){

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

            $array['camping'] = Camping::where('created_by',Auth::user()->id)->where('status','active')->whereRaw($where)->get();
            return view('user.spinner_form.list',$array);
        }
    }

        
    public function downloadFormCampingPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {
                $array['camping'] = Camping::where('created_by',Auth::user()->id)->whereIn('id',$id)->where('status','active')->get();
            $pdf = PDF::loadView('user.spinner_form.campingFormPdf', $array);
        
            return $pdf->download('campingFormPdf.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function spinner_form_list($id){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(spinner_forms.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(spinner_forms.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['id'] = $id;
            $array['SpinnerForm'] = SpinnerForm::
            select(
                'spinner_forms.id',
                'spinner_forms.name',
                'spinner_forms.email',
                'spinner_forms.whatsapp_number',
                'spinner_forms.phone',
                'spinner_forms.address',
                'spinner_forms.schreenshot',
                'spinner_forms.spinner_id',
                'spinner_forms.camping_id',
                'spinner_forms.bike_model_id',
                'spinner_forms.mac_address',
                'spinner_forms.status',
                'spinner_forms.created_at',
                'bike_models.name as bike_name',
                'spinners.name as spinner_name',
                )
            ->leftJoin('bike_models','bike_models.id','spinner_forms.bike_model_id')
            ->leftJoin('spinners','spinners.id','spinner_forms.spinner_id')
            ->where('spinner_forms.camping_id',$id)
            ->whereRaw($where)
            ->get();
            return view('user.spinner_form.spinner_form_list',$array);
        }
    }

            
    public function downloadSpinnerFormListPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
                $campaign_id = $request->campaign_id;
            if ($id != null) {
                $array['SpinnerForm'] = SpinnerForm::
                    select(
                        'spinner_forms.id',
                        'spinner_forms.name',
                        'spinner_forms.email',
                        'spinner_forms.whatsapp_number',
                        'spinner_forms.phone',
                        'spinner_forms.address',
                        'spinner_forms.schreenshot',
                        'spinner_forms.spinner_id',
                        'spinner_forms.camping_id',
                        'spinner_forms.bike_model_id',
                        'spinner_forms.mac_address',
                        'spinner_forms.status',
                        'spinner_forms.created_at',
                        'bike_models.name as bike_name',
                        'spinners.name as spinner_name',
                        )
                    ->leftJoin('bike_models','bike_models.id','spinner_forms.bike_model_id')
                    ->leftJoin('spinners','spinners.id','spinner_forms.spinner_id')
                    ->where('spinner_forms.camping_id',$campaign_id)
                    ->whereIn('spinner_forms.id',$id)
                    ->get();

                    $customPaper = array(0,0,720,1440);

                    $array['camping'] = Camping::where('id',$campaign_id)->first();
            $pdf = PDF::loadView('user.spinner_form.spinnerFormListPdf', $array)->setPaper($customPaper,'portrait');
        
            return $pdf->download('spinnerFormList.pdf');
            } else {
                return back();
            }
                  
        }
    }


    public function delete_spinner_form_list($id){

        if(Auth::check()){
            $SpinnerForm = SpinnerForm::where('id',$id)->delete();
            
            $notification = array(
                'messege'=>'Spinner Form List Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
        }
    }

    public function spinner_form_details($id){

        if(Auth::check()){

            $where = "spinner_forms.id='$id'";
            $array['SpinnerForm'] = SpinnerForm::
            select(
                'spinner_forms.id',
                'spinner_forms.name',
                'spinner_forms.email',
                'spinner_forms.whatsapp_number',
                'spinner_forms.phone',
                'spinner_forms.address',
                'spinner_forms.schreenshot',
                'spinner_forms.spinner_id',
                'spinner_forms.camping_id',
                'spinner_forms.bike_model_id',
                'spinner_forms.mac_address',
                'spinner_forms.status',
                'spinner_forms.created_at',
                'bike_models.name as bike_name',
                'spinners.name as spinner_name',
                )
            ->leftJoin('bike_models','bike_models.id','spinner_forms.bike_model_id')
            ->leftJoin('spinners','spinners.id','spinner_forms.spinner_id')
            ->whereRaw($where)
            ->first();
            
            return view('user.spinner_form.spinner_form_details',$array);
        }
    }

}
