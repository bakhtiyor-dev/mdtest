<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $appends = ['resource_url'];

    protected $casts = [
        'test_category_count' => 'object',
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(ExamUser::class)->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class)->withDefault();
    }

    public function ratingSettings()
    {
        return $this->hasOne(RatingSetting::class, 'id', 'rating_setting_id');
    }

    public function examUser()
    {
        return $this->hasMany(ExamUser::class);
    }

    public function scopeAvailable($query)
    {
        $query->where('end_date', '>=', now());
    }

    public function scopeExpired($query)
    {
        $query->where('end_date', '<', now());
    }

    public function isExpired()
    {
        return $this->end_date < now();
    }

    public function attempts($user)
    {
        return $this->examUser()
            ->where('user_id', $user->id)
            ->first()
            ->attempts
            ->keyBy('attempt_number')
            ->union(
                collect()->range(1, $this->attempts_count)->mapWithKeys(fn($item) => [$item => null])
            )->sortKeys();
    }

    public function availableAttempts($user)
    {
        return $this->attempts($user)->whereNull();
    }

    public function availableAttemptsCount($user)
    {
        return $this->availableAttempts($user)->count();
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/exams/' . $this->getKey());
    }

    public function getTestsCountAttribute()
    {
        return collect($this->test_category_count)->sum('tests_count');
    }

    public function getTestsAttribute()
    {
        $return = collect([]);

        foreach ($this->test_category_count as $item) {
            $return->push(
                TestCategory::find($item->test_category_id)
                    ->tests()
                    ->available()
                    ->with('answers')
                    ->inRandomOrder()
                    ->take($item->tests_count)
                    ->get()
                    ->each(function ($test) {
                        $test->hideCorrectAnswers()
                            ->shuffleAnswers();
                    })
            );
        }

        return $return->collapse();
    }

}
