<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\ScratchCard;
use App\Models\ScratchcardForm;
use App\Models\BikeModel;
use App\Models\Camping;
use Illuminate\Support\Facades\Auth;

use Response;
use PDF;

class ScratchCardController extends Controller
{
     
    public function scratchcard_list(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(scratch_cards.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(scratch_cards.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['scratchcard'] = ScratchCard::select('scratch_cards.*','campings.campaign_name as c_name','campings.title as c_title')
            ->leftJoin('campings','campings.id','scratch_cards.camping_id')
            ->where('scratch_cards.created_by',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($ScratchCard);
            return view('user.scratchcard.list',$array);
        }
    }

    
    
    public function download_scratchcard_pdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {

                $array['ScratchCard'] = ScratchCard::select('scratch_cards.*','campings.campaign_name as c_name','campings.title as c_title')
                    ->leftJoin('campings','campings.id','scratch_cards.camping_id')
                    ->whereIn('scratch_cards.id',$id )
                    ->where('scratch_cards.created_by',Auth::user()->id)
                    ->get();
                $pdf = PDF::loadView('user.scratchcard.pdf', $array);
        
            return $pdf->download('scratchcard.pdf');
            } else {
                return back();
            }
                  
        }
    }


    public function add_scratchcard_page(){

        if(Auth::check()){
            $camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.scratchcard.create',compact('camping'));
        }
    }

    public function scratchcard_form(){

        if(Auth::check()){
            $camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.scratchcard.form',compact('camping'));
        }
    }

    public function add_scratchcard(Request $request){

        //dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                $scratchcard = ScratchCard::find($request->id);

                if ($scratchcard) {
                    // Handle file upload if provided
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);
                        $scratchcard->image = URL('upload/' . $name); // Update image only if file is uploaded
                    }

                    if ($request->hasFile('card_image')) {
                        $file = $request->file('card_image');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);
                        $scratchcard->card_image = URL('upload/' . $name); // Update image only if file is uploaded
                    }
                
                    // Update only if fields are provided
                    if ($request->name !== null && $request->name !== '') {
                        $scratchcard->name = $request->name;
                    }
                    if (isset($request->description) && $request->description !== '') { // Accepts 0 but skips empty descriptions
                        $scratchcard->description = $request->description;
                    }
                    if ($request->color !== null && $request->color !== '') {
                        $scratchcard->color = $request->color;
                    }
                    if (isset($request->price) && $request->price !== '') { // Accepts 0 but prices empty values
                        $scratchcard->price = $request->price;
                    }
                    if ($request->no_of_time_scratch !== null && $request->no_of_time_scratch !== '') {
                        $scratchcard->no_of_time_scratch = $request->no_of_time_scratch;
                    }
                    if ($request->order !== null && $request->order !== '') {
                        $scratchcard->order = $request->order;
                    }
                    if ($request->camping_id !== null && $request->camping_id !== '') {
                        $scratchcard->camping_id = $request->camping_id;
                    }
                    if (isset($request->card_status) && $request->card_status !== '') { // Accepts 0 but skips empty values
                        $scratchcard->card_status = $request->card_status;
                    }
                
                    // Always set created_by to the current user
                    $scratchcard->created_by = Auth::user()->id;
                
                    // Save changes to the scratchcard
                    $scratchcard->save();
                
                    // Update the total scratchcard value in the Camping table
                    $TotalScratchCard = ScratchCard::where('camping_id', $request->camping_id)->sum('no_of_time_scratch');
                    Camping::where('id', $request->camping_id)->update(['total_form' => $TotalScratchCard]);
                
                    // Return success notification
                    return Response::json([
                        'message' => 'ScratchCard updated successfully',
                        'alert-type' => 'success',
                    ]);
                } else {
                    // ScratchCard not found
                    return Response::json([
                        'message' => 'ScratchCard not found',
                        'alert-type' => 'error',
                    ]);
                }

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

                ScratchCard::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'card_image' => $document_link,
                    'image' => $document_link,
                    'color' => $request->color,
                    'price' => $request->price,
                    'no_of_time_scratch' => $request->no_of_time_scratch,
                    'order' => $request->order,
                    'camping_id' => $request->camping_id,
                    'created_by' => Auth::user()->id,
                    'card_status' => $request->card_status
                ]);

                $TotalScratchCard = ScratchCard::where('camping_id',$request->camping_id)->sum('no_of_time_scratch');
                $CampingUpdate = Camping::where('id',$request->camping_id)->update(['total_form'=>$TotalScratchCard]);

                $notification = array(
                    'messege'=>'ScratchCard inserted successfully',
                    'alert-type'=>'success'
                );
                return Response::json($notification);

            }
            


        }
    }

    
    public function edit_scratchcard($id){

        if(Auth::check()){
            $ScratchCard = ScratchCard::where('id',$id)->first();
            $camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.scratchcard.form',compact('ScratchCard','id','camping'));
        }
    }

    public function delete_scratchcard($id){

        if(Auth::check()){
            
            $ScratchCard = ScratchCard::where('id',$id)->delete();

            $notification = array(
                'messege'=>'ScratchCard Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }



    // ScratchCard form ------------------------
    public function scratchcard_form_camping_list(Request $request){

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
            return view('user.scratchcard_form.list',$array);
        }
    }

        
    public function downloadFormCampingPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {
                $array['camping'] = Camping::where('created_by',Auth::user()->id)->whereIn('id',$id)->where('status','active')->get();
            $pdf = PDF::loadView('user.scratchcard_form.campingFormPdf', $array);
        
            return $pdf->download('campingFormPdf.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function scratchcard_form_list($id){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(scratchcard_forms.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(scratchcard_forms.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['id'] = $id;
            $array['ScratchcardForm'] = ScratchcardForm::
            select(
                'scratchcard_forms.id',
                'scratchcard_forms.name',
                'scratchcard_forms.email',
                'scratchcard_forms.whatsapp_number',
                'scratchcard_forms.phone',
                'scratchcard_forms.address',
                'scratchcard_forms.schreenshot',
                'scratchcard_forms.scratchcard_id',
                'scratchcard_forms.camping_id',
                'scratchcard_forms.bike_model_id',
                'scratchcard_forms.mac_address',
                'scratchcard_forms.status',
                'scratchcard_forms.created_at',
                'bike_models.name as bike_name',
                'spinners.name as spinner_name',
                )
            ->leftJoin('bike_models','bike_models.id','scratchcard_forms.bike_model_id')
            ->leftJoin('spinners','spinners.id','scratchcard_forms.scratchcard_id')
            ->where('scratchcard_forms.camping_id',$id)
            ->whereRaw($where)
             ->orderBy('scratchcard_forms.id','desc')
            ->get();
            return view('user.scratchcard_form.list',$array);
        }
    }

            
    public function downloadScratchcardFormListPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
                $campaign_id = $request->campaign_id;
            if ($id != null) {
                $array['ScratchcardForm'] = ScratchcardForm::
                    select(
                        'scratchcard_forms.id',
                        'scratchcard_forms.name',
                        'scratchcard_forms.email',
                        'scratchcard_forms.whatsapp_number',
                        'scratchcard_forms.phone',
                        'scratchcard_forms.address',
                        'scratchcard_forms.schreenshot',
                        'scratchcard_forms.scratchcard_id',
                        'scratchcard_forms.camping_id',
                        'scratchcard_forms.bike_model_id',
                        'scratchcard_forms.mac_address',
                        'scratchcard_forms.status',
                        'scratchcard_forms.created_at',
                        'bike_models.name as bike_name',
                        'scratch_cards.name as spinner_name',
                        )
                    ->leftJoin('bike_models','bike_models.id','scratchcard_forms.bike_model_id')
                    ->leftJoin('scratch_cards','scratch_cards.id','scratchcard_forms.scratchcard_id')
                    ->where('scratchcard_forms.camping_id',$campaign_id)
                    ->whereIn('scratchcard_forms.id',$id)
                    ->get();

                    $customPaper = array(0,0,720,1440);

                    $array['camping'] = Camping::where('id',$campaign_id)->first();
            $pdf = PDF::loadView('user.scratchcard_form.spinnerFormListPdf', $array)->setPaper($customPaper,'portrait');
        
            return $pdf->download('spinnerFormList.pdf');
            } else {
                return back();
            }
                  
        }
    }


    public function delete_scratchcard_form_list($id){

        if(Auth::check()){
            $ScratchcardForm = ScratchcardForm::where('id',$id)->delete();
            
            $notification = array(
                'messege'=>'ScratchCard Form List Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
        }
    }

    public function scratchcard_form_details($id){

        if(Auth::check()){

            $where = "scratchcard_forms.id='$id'";
            $array['ScratchcardForm'] = ScratchcardForm::
            select(
                'scratchcard_forms.id',
                'scratchcard_forms.name',
                'scratchcard_forms.email',
                'scratchcard_forms.whatsapp_number',
                'scratchcard_forms.phone',
                'scratchcard_forms.address',
                'scratchcard_forms.schreenshot',
                'scratchcard_forms.scratchcard_id',
                'scratchcard_forms.camping_id',
                'scratchcard_forms.bike_model_id',
                'scratchcard_forms.mac_address',
                'scratchcard_forms.status',
                'scratchcard_forms.created_at',
                'bike_models.name as bike_name',
                'scratch_cards.name as spinner_name',
                )
            ->leftJoin('bike_models','bike_models.id','scratchcard_forms.bike_model_id')
            ->leftJoin('scratch_cards','scratch_cards.id','scratchcard_forms.scratchcard_id')
            ->whereRaw($where)
            ->first();
            
            return view('user.scratchcard_form.scratchcard_form_details',$array);
        }
    }

}
