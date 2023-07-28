<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUserAttempt extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tests' => 'object',
        'exam' => 'object',
        'user' => 'object'
    ];

    protected $dates = ['started_at', 'finished_at'];

    protected $appends = ['spent_time', 'resource_url', 'rating'];

    public function examUser()
    {
        return $this->belongsTo(ExamUser::class, 'exam_user_id');
    }

    public function scopeFinished($query)
    {
        $query->whereNotNull('finished_at');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['result']))
            $query->whereBetween('result', $filters['result']);

        if (isset($filters['exam']))
            $query->where('exam->id', $filters['exam']);

        if (isset($filters['user']))
            $query->where('user->id', $filters['user']);
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/exam-user-attempts/' . $this->getKey());
    }

    public function getRatingAttribute()
    {
        return collect($this->exam->rating_settings->settings)
            ->filter(fn($setting) => ($setting->start <= $this->result && $this->result <= $setting->end))
            ->first();
    }

    public function getSpentTimeAttribute()
    {
        return isset($this->finished_at) ? $this->started_at->diffInMinutes($this->finished_at) : 0;
    }

    public function getCorrectAnswersCountAttribute()
    {
        return collect($this->tests)
            ->filter(fn($test) => (isset($test->is_answered) && $test->is_correct))
            ->count();
    }

    public function getWrongAnswersCountAttribute()
    {
        return collect($this->tests)
            ->filter(fn($test) => (isset($test->is_answered) && !$test->is_correct))
            ->count();
    }

    public function getUnansweredTestsCountAttribute()
    {
        return count($this->tests) - $this->wrong_answers_count - $this->correct_answers_count;
    }


}
