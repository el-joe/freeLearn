<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Web\WebController;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('login',[AuthController::class,'getLogin'])->name('getLogin');
        Route::post('login',[AuthController::class,'postLogin'])->name('postLogin');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', function () {
            $totalYearRevenue = Subscription::whereYear('created_at',now()->year)->whereStatus('success')->get()
                ->map(function ($subscription){
                    return [
                        'amount'=>$subscription->amount,
                        'month'=>Carbon::parse($subscription->created_at)->format('m')
                    ];
                })->groupBy('month')->map(function ($subscriptions,$month){
                    return $subscriptions->sum('amount');
                });

            $yearRevenue = [];

            for ($i=1; $i <= 12 ; $i++) {
                $month = $i;
                if($month < 10){
                    $month = '0'.$month;
                }
                // get month short name
                $_month = Carbon::parse('2021-'.$month)->shortMonthName;
                $yearRevenue[] = [
                    'month'=>$_month,
                    'amount'=>$totalYearRevenue[$month] ?? 0
                ];
            }

            return view('admin.dashboard',get_defined_vars());
        })->name('dashboard');

        Route::resource('subjects',SubjectController::class);
        Route::get('contacts',[SubjectController::class,'contacts'])->name('contacts.index');
        Route::resource('academic-years',AcademicYearController::class);
        Route::resource('lessons',LessonController::class);
        Route::get('lessons/{lesson}/exam',[LessonController::class,'exam'])->name('lesson.exam');
        Route::post('lessons/{lesson}/exam',[LessonController::class,'examUpdate'])->name('lesson.examUpdate');

        Route::get('subscriptions',[SubscriptionController::class,'index'])->name('subscriptions.index');
    });
});


Route::get('/',[WebController::class,'home'])->name('home');
Route::get('subjects',[WebController::class,'subjects'])->name('subjects');
Route::get('years/{subjectId}',[WebController::class,'years'])->name('years');
Route::get('playlist/y{yearId}-sub{subjectId}-s{semester}',[WebController::class,'playlist'])->name('playlist');
Route::get('video/{lessonId}',[WebController::class,'video'])->name('video');
Route::get('exam/{lessonId}',[WebController::class,'exam'])->name('exam');
Route::get('contact-us',[WebController::class,'contactUs'])->name('contactUs');
Route::post('contact-us',[WebController::class,'contactUsPost'])->name('contactUsPost');
