<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
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
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'status',
        'description',
        'finished_at',
        'slug'
    ];

    protected $casts = [
        'finished_at' => 'datetime',
    ];

    protected $appends = ['details', 'my_rank'];

    public function getDetailsAttribute()
    {
        return [
            'average' =>  round($this->results()->avg('grade')),
            'join_count' => $this->results()->count()
        ];
    }

    public function getMyRankAttribute()
    {
        $rank = 0;
        foreach ($this->results()->orderByDesc('grade')->get() as $result){

            $rank++;

            if(auth()->id() === $result->user_id){
                return $rank;
            }
        }

        return null;
    }

    public function result()
    {
        return $this->hasOne(Result::class)->where('user_id', auth()->id());
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function topTen()
    {
        return $this->results()->orderByDesc('grade')->take(10);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
