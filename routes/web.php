<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SpinnerController;
use App\Http\Controllers\CampingController;
use App\Http\Controllers\BikeModelController;
use App\Http\Controllers\FormFieldsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PrivateReviewController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PopupalertController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[UserController::class,'login'])->name('login');
Route::get('/u/{user_name}',[FrontendController::class,'index']);
Route::post('/u/review_form_submit',[FrontendController::class,'review_form_submit']);
Route::post('/u/private_feedback',[FrontendController::class,'private_feedback']);
Route::post('/u/spinner_form/post',[FrontendController::class,'spinner_form']);
Route::post('/u/spinner_form_check/post',[FrontendController::class,'spinner_form_check']);
Route::post('/u/spinner_round_check',[FrontendController::class,'spinner_round_check']);
Route::post('/u/spinner_value_check',[FrontendController::class,'spinner_value_check']);
Route::get('/dummy',[FrontendController::class,'dummy']);

Route::get('login',[UserController::class,'login']);
Route::post('login_post',[UserController::class,'login_post']);
Route::get('logout',[UserController::class,'logout']);

Route::any('otp_verify_page',[UserController::class,'otp_verify_page']);
Route::any('otp_verify',[UserController::class,'otp_verify']);
Route::get('forgotPassword',[UserController::class,'forgotPassword']);
Route::post('adminUserIdCheck',[UserController::class,'adminUserIdCheck']);
Route::get('confirmPasswordPage/{adminKey}',[UserController::class,'confirmPasswordPage']);
Route::post('confirmPassword',[UserController::class,'confirmPassword']);
Route::get('changePassword',[UserController::class,'changePassword']);
Route::post('updatePassword',[UserController::class,'updatePassword']);


Route::post('form_submit',[FrontendController::class,'submitForm']);



Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [UserController::class,'dashboard']);
    Route::get('profile', [UserController::class,'profile']);
    Route::post('profile_update', [UserController::class,'profile_update']);
    Route::get('logout', [UserController::class,'logout']);
    Route::any('sub_user_list', [UserController::class,'sub_user_list']);
    Route::get('add_sub_user_page', [UserController::class,'add_sub_user_page']);
    Route::any('user_name_checking', [UserController::class,'user_name_checking']);
    Route::post('add_sub_user', [UserController::class,'add_sub_user']);
    Route::post('downloadUserPdf', [UserController::class,'downloadUserPdf']);
    Route::get('edit_sub_user/{id}', [UserController::class,'edit_sub_user']);
    Route::get('delete_sub_user/{id}', [UserController::class,'delete_sub_user']);
    Route::get('expiry_sub_user', [UserController::class,'expiry_sub_user']);
    Route::get('profile', [UserController::class,'profile']);
    Route::post('profile_update', [UserController::class,'profile_update']);
    Route::get('dashboard_visit/{id}', [UserController::class,'dashboard_visit']);
    Route::get('view_qr', [UserController::class,'view_qr']);
    Route::get('print_qr_code', [UserController::class,'print_qr_code']);
    Route::get('generatePDF', [UserController::class,'generatePDF']);
    Route::get('/show-qrcode', [UserController::class,'showQRCode'])->name('show-qrcode');
    Route::post('/spin_pi_clear', [UserController::class,'spin_pi_clear']);
    Route::post('/change_spin_mode', [UserController::class,'change_spin_mode']);


    // ----------------- UserController ------------------------
    Route::any('ip_skip', [UserController::class,'ip_skip']);
    Route::get('add_ip_skip_page', [UserController::class,'add_ip_skip_page']);
    Route::post('add_ip_skip', [UserController::class,'add_ip_skip']);
    Route::post('downloadCampaignPdf', [UserController::class,'downloadCampaignPdf']);
    Route::get('edit_ip_skip/{id}', [UserController::class,'edit_ip_skip']);
    Route::get('delete_ip_skip/{id}', [UserController::class,'delete_ip_skip']);
    // ----------------- UserController End------------------------


    // ----------------- Camping ------------------------
    Route::any('camping_list', [CampingController::class,'camping_list']);
    Route::get('add_camping_page', [CampingController::class,'add_camping_page']);
    Route::post('add_camping', [CampingController::class,'add_camping']);
    Route::post('downloadCampaignPdf', [CampingController::class,'downloadCampaignPdf']);
    Route::get('edit_camping/{id}', [CampingController::class,'edit_camping']);
    Route::get('delete_camping/{id}', [CampingController::class,'delete_camping']);
    // ----------------- Camping End------------------------


    // ----------------- Bike ------------------------
    Route::any('bike_model', [BikeModelController::class,'bike_model']);
    Route::get('add_bike_page', [BikeModelController::class,'add_bike_page']);
    Route::post('downloadBikePdf', [BikeModelController::class,'downloadBikePdf']);
    Route::post('add_bike', [BikeModelController::class,'add_bike']);
    Route::get('edit_bike/{id}', [BikeModelController::class,'edit_bike']);
    Route::get('delete_bike/{id}', [BikeModelController::class,'delete_bike']);
    // ----------------- Bike End------------------------

    // ----------------- Form Fields Access ------------------------
    Route::any('form_field', [FormFieldsController::class,'form_field']);
    Route::any('add_form_page', [FormFieldsController::class,'add_form_page']);
    Route::any('field_form', [FormFieldsController::class,'field_form']);
    Route::post('add_input_field', [FormFieldsController::class,'add_input_field']);
    Route::post('add_input_field_data', [FormFieldsController::class,'add_input_field_data']);
    Route::get('edit_form_field/{id}', [FormFieldsController::class,'edit_form_field']);
    Route::get('delete_form_field/{id}', [FormFieldsController::class,'delete_form_field']);
    Route::get('review_list', [FormFieldsController::class,'review_list']);
    Route::get('view_review/{id}', [FormFieldsController::class,'view_review']);


    Route::any('form_access', [FormFieldsController::class,'form_access']);
    Route::any('form_access_post', [FormFieldsController::class,'form_access_post']);
    // ----------------- Form Fields Access End------------------------


    // ----------------- Review Links ------------------------
    Route::any('review_links', [ReviewController::class,'review_links']);
    Route::any('review_links_form', [ReviewController::class,'review_links_form']);
    Route::post('add_review_links', [ReviewController::class,'add_review_links']);
    Route::get('edit_review_links/{id}', [ReviewController::class,'edit_review_links']);
    Route::get('delete_review_links/{id}', [ReviewController::class,'delete_review_links']);

    // ----------------- Review Links End------------------------


    // ----------------- Spinner ------------------------
    Route::any('spinner_list', [SpinnerController::class,'spinner_list']);
    Route::get('add_spinner_page', [SpinnerController::class,'add_spinner_page']);
    Route::get('spinner_form', [SpinnerController::class,'spinner_form']);
    Route::post('add_spinner', [SpinnerController::class,'add_spinner']);
    Route::post('downloadSpinnerPdf', [SpinnerController::class,'downloadSpinnerPdf']);
    Route::get('edit_spinner/{id}', [SpinnerController::class,'edit_spinner']);
    Route::get('delete_spinner/{id}', [SpinnerController::class,'delete_spinner']);
    Route::any('spinner_form_camping_list', [SpinnerController::class,'spinner_form_camping_list']);
    Route::post('downloadFormCampingPdf', [SpinnerController::class,'downloadFormCampingPdf']);
    Route::post('downloadSpinnerFormListPdf', [SpinnerController::class,'downloadSpinnerFormListPdf']);
    Route::any('spinner_form_list/{id}', [SpinnerController::class,'spinner_form_list']);
    Route::any('delete_spinner_form_list/{id}', [SpinnerController::class,'delete_spinner_form_list']);
    // ----------------- Spinner End------------------------


    // ----------------- Private Review ------------------------
    Route::any('private_review_list', [PrivateReviewController::class,'private_review_list']);
    Route::get('add_private_review_page', [PrivateReviewController::class,'add_private_review_page']);
    Route::post('add_private_review', [PrivateReviewController::class,'add_private_review']);
    Route::post('download_private_review_Pdf', [PrivateReviewController::class,'download_private_review_Pdf']);
    Route::get('edit_private_review/{id}', [PrivateReviewController::class,'edit_private_review']);
    Route::get('delete_private_review/{id}', [PrivateReviewController::class,'delete_private_review']);
    // ----------------- Private Review End------------------------


    
    // ----------------- Private Review ------------------------
    Route::any('questions', [QuestionController::class,'questions']);
    Route::any('question_field_form', [QuestionController::class,'question_field_form']);
    Route::post('questions_form', [QuestionController::class,'questions_form']);
    Route::post('add_input_field_data', [QuestionController::class,'add_input_field_data']);
    Route::get('edit_question/{id}', [QuestionController::class,'edit_question']);
    Route::get('edit_question/{id}', [QuestionController::class,'edit_question']);
    Route::get('view_question/{id}', [QuestionController::class,'view_question']);
    Route::get('view_question_answers', [QuestionController::class,'view_question_answers']);
    // ----------------- Private Review End------------------------

    
    // ----------------- Notice ------------------------
    Route::any('notice', [NoticeController::class,'notice']);
    Route::any('add_notice', [NoticeController::class,'add_notice']);
    // ----------------- Notice End------------------------

    
    // ----------------- Popupalert ------------------------
    Route::any('popup_alert', [PopupalertController::class,'popup_alert']);
    Route::any('add_popup_alert', [PopupalertController::class,'add_popup_alert']);
    // ----------------- Popupalert End------------------------


});

