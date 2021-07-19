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
        $quiz = Quiz::whereSlug($slug)
            ->withCount('questions')
            ->first();

        return view('admin.quiz.detail', [
            'quiz' => $quiz
        ]);
    }

    public function join()
    {

    }
}
