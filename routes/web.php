<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizJoinController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']],function (){
    Route::get('home',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('quiz/{slug}',[DashboardController::class, 'show'])->name('quiz.detail');

    Route::get('quiz/{slug}/join',[QuizJoinController::class, 'index'])->name('quiz.join');
    Route::post('quiz/{slug}',[QuizJoinController::class, 'store'])->name('quiz.join.store');
});

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'],function (){
    Route::resource('quizzes',QuizController::class);
    Route::resource('quiz/{quiz}/questions',QuestionController::class);
});
