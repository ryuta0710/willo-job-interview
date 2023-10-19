<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyJobController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InterviewController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/fetch/{period}', [HomeController::class, 'fetch'])->name('home.fetch');


Route::controller(MyJobController::class)->group(function(){

    Route::get('myjob', 'index')->name('myjob.index');

    Route::post('myjob/search', 'search')->name('myjob.search');

    Route::post('myjob', 'store')->name('myjob.store');

    Route::get('myjob/create', 'create')->name('myjob.create');

    Route::get('myjob/{myjob}/create-questions', 'create_questions')->name('myjob.create_questions');

    Route::post('myjob/{myjob}/store-questions', 'store_questions')->name('myjob.store_questions');

    Route::get('myjob/{myjob}/select-messages', 'select_messages')->name('myjob.select_messages');
    
    Route::post('myjob/{myjob}/store-messages', 'store_messages')->name('myjob.store_messages');

    Route::get('myjob/{myjob}/publish', 'publish')->name('myjob.publish');

    Route::post('myjob/{myjob}/publish', 'store_publish')->name('myjob.store_publish');

    Route::get('myjob/{myjob}', 'show')->name('myjob.show');

    Route::put('myjob/{id}', 'update')->name('myjob.update');

    Route::get('myjob/{id}/copy', 'copy')->name('myjob.copy');

    Route::delete('myjob/{myjob}', 'destroy')->name('myjob.destroy');

    Route::get('myjob/{candidate_id}/create_ics/{date1}/{date2}', 'create_ics')->name('myjob.create_ics');

    Route::get('myjob/{myjob}/edit', 'edit')->name('myjob.edit');

    Route::get('myjob/{myjob}/{candidate_id}/edit', 'person')->name('myjob.person');
    
    Route::post('candidate/add_note/{candidate_id}', 'add_note')->name('myjob.add_note');
    
    Route::post('candidate/change_status/{candidate_id}', 'candidate_status_change')->name('myjob.candidate_status_change');

    Route::post('candidate/review_change/{candidate_id}', 'candidate_review_change')->name('myjob.candidate_review_change');


})->middleware('auth');;

Route::controller(MemberController::class)->group(function(){

    Route::get('member', 'index')->name('member.index');

    Route::post('member/search', 'search')->name('member.search');

    Route::post('member/{candidate_id}/reject', 'reject')->name('member.reject');

    Route::post('member/candidate_share/{candidate_id}', 'candidate_share')->name('member.candidate_share');

    // Route::post('member', 'store')->name('member.store');

    // Route::get('member/create', 'create')->name('member.create');

    // Route::get('member/{member}', 'show')->name('member.show');

    // Route::put('member/{member}', 'update')->name('member.update');

    // Route::delete('member/{member}', 'destroy')->name('member.destroy');

    // Route::get('member/{member}/edit', 'edit')->name('member.edit');
});

Route::controller(CompanyController::class)->group(function(){

    Route::get('company', 'index')->name('company.index');

    Route::post('company', 'store')->name('company.store');

    Route::get('company/create', 'create')->name('company.create');

    // Route::get('company/{company}', 'show')->name('company.show');
    
    Route::put('company/{id}', 'update')->name('company.update');

    Route::delete('company/{id}', 'destroy')->name('company.destroy');

    Route::get('company/{id}/edit', 'edit')->name('company.edit');

    Route::get('company/{id}/detail', 'detail')->name('company.detail');

    Route::get('company/{id}/fetch/{period}', 'fetch')->name('company.fetch');
});

Route::controller(TemplateController::class)->group(function(){

    Route::get('template', 'index')->name('template.index');

    Route::post('/template', 'store')->name('template.store');

    Route::post('/template/search', 'search')->name('template.search');

    Route::get('template/create', 'create')->name('template.create');

    Route::post('template/{id}/copy', 'copy')->name('template.copy');

    Route::get('template/{id}', 'show')->name('template.show');

    Route::put('template/{template}', 'update')->name('template.update');

    Route::delete('template/{template}', 'destroy')->name('template.destroy');

    Route::get('template/{template}/edit', 'edit')->name('template.edit');
});

Route::controller(ProfileController::class)->group(function(){

    Route::get('profile', 'index')->name('profile.index');

    // Route::post('profile', 'store')->name('profile.store');

    // Route::get('profile/create', 'create')->name('profile.create');

    // Route::get('profile/{profile}', 'show')->name('profile.show');

    Route::put('profile', 'update')->name('profile.update');

    // Route::delete('profile/{profile}', 'destroy')->name('profile.destroy');

    // Route::get('profile/{profile}/edit', 'edit')->name('profile.edit');
});

Route::controller(UserController::class)->group(function(){

    Route::get('user', 'index')->name('user.index');
    //save
    Route::post('user', 'store')->name('user.store');

    // Route::get('user/create', 'create')->name('user.create');

    // Route::get('user/{user}', 'show')->name('user.show');

    Route::put('user/{id}', 'update')->name('user.update');

    Route::delete('user/{id}', 'destroy')->name('user.destroy');

    // Route::get('user/{user}/edit', 'edit')->name('user.edit');
});

Route::controller(InterviewController::class)->group(function(){

    Route::get('interview/{url}', 'index')->name('interview.index');
    //create answer
    Route::post('interview/{url}/create-answer', 'create_answer')->name('interview.create_answer');
    
    Route::get('interview/{url}/confirm', 'confirm')->name('interview.confirm');

    Route::get('interview/{url}/booking', 'booking')->name('interview.booking');

    Route::post('interview/{url}/booking', 'save_booking')->name('interview.save_booking');
    //save
    Route::get('interview/{candidate_url}/{answer_url}', 'answer')->name('interview.answer');
    //save
    Route::post('interview/{url}/video', 'save_video')->name('interview.save_video');

    Route::post('interview/{url}/audio', 'save_audio')->name('interview.save_audio');

    Route::post('interview/{url}/text', 'save_text')->name('interview.save_text');

    Route::post('interview/{url}/file', 'save_file')->name('interview.save_file');

    Route::post('interview/{url}/ai', 'save_ai')->name('interview.save_ai');
    // Route::post('interview', 'store')->name('interview.store');

    // Route::get('interview/create', 'create')->name('interview.create');

    // Route::get('interview/{user}', 'show')->name('interview.show');

    Route::put('interview/{id}', 'update')->name('interview.update');

    Route::post('interview/{id}/status', 'status')->name('interview.status');

    Route::delete('interview/{id}', 'destroy')->name('interview.destroy');

    Route::post('interview/{id}/search', 'search')->name('interview.search');

    Route::delete('candidate/{candidate_id}/remove', 'candidate_remove')->name('interview.candidate_remove');

    // Route::get('interview/{user}/edit', 'edit')->name('interview.edit');

    Route::get('interview-closed', 'interview_closed')->name('interview.interview_closed');
});


// Route::get('invite-people/{myjob}', [OtherController::class, 'invitePeople'])->name('invite-people');
// Route::get('redirect-interview/{url}', [OtherController::class, 'redirect_interview'])->name('redirect-interview');
// Route::get('getJobList', [OtherController::class, 'getJobList'])->name('getJobList');
// Route::get('public-candidate/{candidate_id}', [OtherController::class, 'publicCandidate'])->name('publicCandidate');
// Route::post('fetchJobs', [OtherController::class, 'fetchJobs'])->name('fetchJobs');
// Route::get('getJobDetail/{url}', [OtherController::class, 'getJobDetail'])->name('getJobDetail');
// Route::get('contact', [OtherController::class, 'contact'])->name('contact');
// Route::get('privacy', [OtherController::class, 'privacy'])->name('privacy');


Route::controller(OtherController::class)->group(function(){

    Route::get('invite-people/{myjob}', 'invitePeople')->name('invite-people');

    Route::get('redirect-interview/{url}', 'redirect_interview')->name('redirect-interview');

    Route::get('getJobList', 'getJobList')->name('getJobList');

    Route::get('public-candidate/{candidate_id}', 'publicCandidate')->name('publicCandidate');

    Route::get('fetchJobs', 'fetchJobs')->name('fetchJobs');

    Route::get('getJobDetail/{url}', 'getJobDetail')->name('getJobDetail');

    Route::get('contact', 'contact')->name('contact');

    Route::get('privacy', 'privacy')->name('privacy');
});
