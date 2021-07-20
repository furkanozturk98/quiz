<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $answers = [
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'option_e'
        ];

        return [
            'user_id' => 1,
            'question_id' => rand(1,100),
            'answer' => $answers[rand(0,4)]
        ];
    }
}
