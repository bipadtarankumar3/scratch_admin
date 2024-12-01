<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\FormFields;
use App\Models\ReviewForm;
use App\Models\ReviewFormField;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionResult;
use Illuminate\Support\Facades\Auth;
use Response;
use PDF;

class QuestionController extends Controller
{
    public function questions(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(questions.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(questions.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['Question'] = Question::where('questions.user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.question.list',$array);
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

    public function question_field_form(){

        if(Auth::check()){
            //$camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.question.form');
        }
    }



    public function questions_form(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                $Question = Question::where('id',$request->id)->update([
                    'question' => $request->question,
                    'status' => $request->status
                ]);

                $answers = $request->answers;
                $right_answer = $request->right_answer;
                $QuestionAnswer = QuestionAnswer::where('question_id',$request->id)->delete();
                // dd( $right_answer );
                foreach ($answers as $key => $value) {
                    QuestionAnswer::create([
                        'question_id' => $request->id,
                        'answers' => $value,
                        'right_answer' => $right_answer[$key],
                        'user_id' => Auth::user()->id
                    ]);
                }

                $notification = array(
                    'messege'=>'Question Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);

            } else {


                $Question = Question::create([
                    'question' => $request->question,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $answers = $request->answers;
                $right_answer = $request->right_answer;

                // dd( $right_answer );
                foreach ($answers as $key => $value) {
                    QuestionAnswer::create([
                        'question_id' => $Question->id,
                        'answers' => $value,
                        'right_answer' => $right_answer[$key],
                        'user_id' => Auth::user()->id
                    ]);
                }

                $notification = array(
                    'messege'=>'Data inserted successfully',
                    'alert-type'=>'success'
                );
                return Response::json($notification);

            }
            
        }
    }

    public function edit_question($id){

        if(Auth::check()){
            $Question = Question::where('id',$id)->first();
            $QuestionAnswer = QuestionAnswer::where('question_id',$id)->get();
            return view('user.question.form',compact('Question','QuestionAnswer','id'));
        }
    }

    public function view_question($id){

        if(Auth::check()){
            $Question = Question::where('id',$id)->first();
            $QuestionAnswer = QuestionAnswer::where('question_id',$id)->get();
            return view('user.question.view_question',compact('Question','QuestionAnswer','id'));
        }
    }

    public function delete_question($id){

        if(Auth::check()){
            
            $Question = Question::where('id',$id)->delete();
            $QuestionAnswer = QuestionAnswer::where('question_id',$id)->delete();

            $notification = array(
                'messege'=>'Question Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

    public function view_question_answers(){

        if(Auth::check()){
            
            $QuestionResult = QuestionResult::join('questions','questions.id','question_results.r_question_id')
            ->join('question_answers','question_answers.id','question_results.result_id')
            ->where('question_results.user_id',Auth::user()->id)
            ->get();

            // dd( $QuestionResult );

            return view('user.question.view_question_answers',compact('QuestionResult'));
            
        }
    }

}
