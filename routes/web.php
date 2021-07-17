<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use Illuminate\Support\Facades\Route;


/*Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'],function (){
    Route::resource('quizzes',QuizController::class);
    Route::resource('quiz/{quiz}/questions',QuestionController::class);
});
