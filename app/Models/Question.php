<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $quiz_id
 * @property string $question
 * @property string|null $image
 * @property string $option_a
 * @property string $option_b
 * @property string $option_c
 * @property string $option_d
 * @property string $option_e
 * @property string $correct_answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\QuestionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAnswer4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCorrectAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'image',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'correct_answer'
    ];

    public function my_answer()
    {
        return $this->hasOne(Answer::class)->where('user_id',auth()->id());
    }
}
