<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\QuizStatus;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $quizzes = Quiz::query()
            ->where('status', '=',(string)QuizStatus::ACTIVE)
            ->withCount('questions')
            ->paginate(5);

        return view('dashboard',[
            'quizzes' => $quizzes
        ]);
    }

    public function show($slug)
    {

        /** @var Quiz $quiz */
         $quiz = Quiz::whereSlug($slug)
            ->with('result','topTen.user')
            ->withCount('questions')
            ->first();

        return view('admin.quiz.detail', [
            'quiz' => $quiz
        ]);
    }
}
