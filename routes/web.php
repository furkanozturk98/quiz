<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizJoinController;
use Illuminate\Support\Facades\Route;


/*Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

Route::group(['middleware' => ['auth']],function (){
    Route::get('home',[HomeController::class, 'index'])->name('dashboard');

    Route::get('quiz/{slug}',[HomeController::class, 'show'])->name('quiz.detail');

    Route::get('quiz/{slug}/join',[QuizJoinController::class, 'index'])->name('quiz.join');
    Route::post('quiz/{slug}',[QuizJoinController::class, 'store'])->name('quiz.join.store');
});

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'],function (){
    Route::resource('quizzes',QuizController::class);
    Route::resource('quiz/{quiz}/questions',QuestionController::class);
});
