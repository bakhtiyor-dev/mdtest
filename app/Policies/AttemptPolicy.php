<?php

namespace App\Policies;

use App\Models\ExamUserAttempt;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttemptPolicy
{
    use HandlesAuthorization;

    public function show(User $user, ExamUserAttempt $attempt)
    {
        return $attempt->user->id == $user->id;
    }

}
