<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function isAssignedUser(User $user,Task $task): bool
    {
        return $task->assigned === $user->id;
    }


}
