<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'quiz_id' => rand(1,10),
            'question' => $this->faker->sentence(rand(3,7)),
            'option_a' => $this->faker->sentence(rand(1,4)),
            'option_b' => $this->faker->sentence(rand(1,4)),
            'option_c' => $this->faker->sentence(rand(1,4)),
            'option_d' => $this->faker->sentence(rand(1,4)),
            'option_e' => $this->faker->sentence(rand(1,4)),
        ];
        $keys = array_keys($data);
        $data['correct_answer'] = $keys[rand(1,5)+1];

        return $data;
    }
}
