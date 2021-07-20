<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class QuizJoinController extends Controller
{
    public function index($slug)
    {
        /** @var Quiz $quiz */
        $quiz = Quiz::whereSlug($slug)
            ->with('questions')
            ->first();

        return view('admin.quiz.join', [
            'quiz' => $quiz
        ]);
    }

    public function store(Request $request, $slug)
    {
        $quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404);

        $correct = 0;

        if($quiz->result){
            abort(404, "You already joined this quiz");
        }

        foreach ($quiz->questions as $question){

            Answer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $question->id,
                'answer_id' => $request->input($question->id)

            ]);

            if($question->correct_answer === $request->post($question->id)){
                $correct++;
            }
        }

        $grade = round((100/count($quiz->questions)) * $correct);

        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'grade' => $grade,
            'correct' => $correct,
            'wrong' => count($quiz->questions) - $correct,
        ]);

        return redirect()->route('dashboard')->withSuccess('You successfully finished the quiz. Your grade is '.$grade);
    }
}
