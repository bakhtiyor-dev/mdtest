<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    public function retrieve(User $user, Exam $exam)
    {
        return $user->exams()->where('exam_id', $exam->id)->exists();
    }

    public function take(User $user, Exam $exam)
    {
        if (!$user->exams()->where('exam_id', $exam->id)->exists())
            return false;

        if ($exam->isExpired())
            return false;

        if ($exam->availableAttemptsCount($user) <= 0)
            return false;

        return true;
    }

    public function finish(User $user, Exam $exam)
    {
        if ($exam->availableAttemptsCount($user) >= 0)
            return true;

        return false;
    }

}
