<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => [
                'required',
                'min:3'
            ],
            'image' => [
                'image' ,
                'nullable',
                'max:1024'
            ],
            'answer1' => $this->getAnswerRule(),
            'answer2' => $this->getAnswerRule(),
            'answer3' => $this->getAnswerRule(),
            'answer4' => $this->getAnswerRule(),
            'correct_answer' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function getAnswerRule()
    {
        return ['required', 'min:3'];
    }
}
