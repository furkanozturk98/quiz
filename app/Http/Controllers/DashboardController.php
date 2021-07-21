<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\QuizStatus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $quizzes = Quiz::query()
            ->where('status', '=',(string)QuizStatus::ACTIVE)
            ->where(function ($query){
                $query->where('finished_at', '>', now())
                    ->orWhereNull('finished_at');
            })
            ->withCount('questions')
            ->paginate(5);

        $results = auth()->user()->results;

        return view('dashboard',[
            'quizzes' => $quizzes,
            'results' => $results
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
