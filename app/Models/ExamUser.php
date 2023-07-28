<?php

namespace App\Models;

use App\Notifications\UserAttachedToExam;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExamUser extends Pivot
{
    use HasFactory;

    protected $table = 'exam_user';

    public $incrementing = true;

    public function attempts()
    {
        return $this->hasMany(ExamUserAttempt::class, 'exam_user_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notify()
    {
        try {
            $this->user->notify(new UserAttachedToExam($this->exam));
        } catch (Exception $exception) {
            return ['success' => false, 'error' => $exception->getMessage()];
        }

        $this->update(['notified' => true]);

        return ['success' => true];
    }

    public function scopeUnNotified($query)
    {
        $query->where('notified', false);
    }

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/exam-users/' . $this->getKey());
    }

}
