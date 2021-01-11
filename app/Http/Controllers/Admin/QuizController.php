<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizFormRequest;
use App\Models\Quiz;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $quizzes = Quiz::query()->paginate(5);

        return view('admin.quiz.index',[
            'quizzes' => $quizzes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.quiz.form',[
            'quiz' => new Quiz()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuizFormRequest $request)
    {
        Quiz::query()->create($request->validated());

        return redirect()->route('quizzes.index')->with('success','Quiz created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quiz $quiz
     * @return View
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quiz.form',[
            'quiz' => $quiz
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuizFormRequest $request
     * @param Quiz $quiz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuizFormRequest $request, Quiz $quiz)
    {
        $quiz->update($request->validated());

        return redirect()->route('quizzes.index')->with('success','Quiz updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quiz $quiz
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success','Quiz deleted successfully.');

    }
}
