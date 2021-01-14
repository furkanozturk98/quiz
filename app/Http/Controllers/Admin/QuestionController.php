<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionFormRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Quiz $quiz
     * @return View
     */
    public function index(Quiz $quiz)
    {
        return view('admin.question.index', [
            'quiz' => $quiz
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Quiz $quiz
     * @return View
     */
    public function create(Quiz $quiz)
    {
        return view('admin.question.form', [
            'quiz' => $quiz,
            'question' => new Question()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionFormRequest $request
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    public function store(QuestionFormRequest $request,Quiz $quiz)
    {
        $attributes =  $request->validated();

        if($request->hasFile('image')){
            $fileName = Str::slug($request->question).'.'.$request->image->extension();
            $fileNameWithUpload = $fileName;
            $attributes['image']->move(public_path('uploads'),$fileName);
            $attributes['image'] = $fileNameWithUpload;
        }

        $quiz->questions()->create($attributes);

        return redirect()->route('questions.index',$quiz)->with('success','Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Quiz $quiz
     * @param Question $question
     * @return void
     */
    public function show(Quiz $quiz, Question $question)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quiz $quiz
     * @param Question $question
     * @return View
     */
    public function edit(Quiz $quiz,Question $question)
    {
        return view('admin.question.form', [
            'quiz' => $quiz,
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Quiz $quiz
     * @param int $id
     * @return void
     */
    public function update(Request $request, Quiz $quiz ,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quiz $quiz
     * @param Question $question
     * @return void
     */
    public function destroy(Quiz $quiz,Question $question)
    {
        //
    }
}
