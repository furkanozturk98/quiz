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
     *
     * @return View
     */
    public function index(Quiz $quiz): View
    {
        return view('admin.question.index', [
            'quiz'      => $quiz,
            'questions' => $quiz->questions()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Quiz $quiz
     *
     * @return View
     */
    public function create(Quiz $quiz): View
    {
        return $this->getForm($quiz, new Question());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionFormRequest $request
     * @param Quiz $quiz
     *
     * @return RedirectResponse
     */
    public function store(QuestionFormRequest $request, Quiz $quiz): RedirectResponse
    {
        $attributes =  $request->validated();

        $attributes = $this->checkImage($request, $attributes);

        $quiz->questions()->create($attributes);

        return redirect()->route('questions.index', $quiz)->with('success', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Quiz $quiz
     * @param Question $question
     *
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
     *
     * @return View
     */
    public function edit(Quiz $quiz, Question $question): View
    {
        return $this->getForm($quiz, $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionFormRequest $request
     * @param Quiz $quiz
     * @param Question $question
     *
     * @return RedirectResponse
     */
    public function update(QuestionFormRequest $request, Quiz $quiz, Question $question): RedirectResponse
    {
        $attributes = $request->validated();

        $attributes = $this->checkImage($request, $attributes);

        $question->update($attributes);

        return redirect()->route('questions.index', $quiz)->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quiz $quiz
     * @param Question $question
     *
     * @return RedirectResponse
     */
    public function destroy(Quiz $quiz, Question $question): RedirectResponse
    {
        try {
            $question->delete();
        } catch (\Exception $e) {
        }

        return redirect()->route('questions.index', $quiz)->with('success', 'Question deleted successfully');
    }

    /**
     * @param Quiz $quiz
     * @param Question $question
     *
     * @return View
     */
    public function getForm(Quiz $quiz, Question $question): View
    {
        return view('admin.question.form', [
            'quiz' => $quiz,
            'question' => $question
        ]);
    }

    /**
     * @param QuestionFormRequest $request
     * @param array $attributes
     *
     * @return array
     */
    public function checkImage(QuestionFormRequest $request, array $attributes): array
    {
        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->input('question')) . '.' . $request->file('image')->extension();
            $fileNameWithUpload = $fileName;
            $attributes['image']->move(public_path('uploads'), $fileName);
            $attributes['image'] = $fileNameWithUpload;
        }
        return $attributes;
    }
}
