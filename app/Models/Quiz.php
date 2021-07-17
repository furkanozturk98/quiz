<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Quiz
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property string|null $finished_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Database\Factories\QuizFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'finished_at'
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
