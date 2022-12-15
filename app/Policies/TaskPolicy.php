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

    public function canAccept(User $user,Task $task): bool
    {
        return $this->isAssignedUser($user,$task) && $task->isPending();
    }

    public function canAssign(User $user,Task $task)
    {
        return $task->isPending() && $this->isAssignedUser($user,$task);
    }

    public function canModify(User $user,Task $task)
    {
        return $this->isOwner($user,$task) && $task->isPending();
    }

    public function isOwner(User $user,Task $task)
    {
        return $task->owner==$user->id;
    }
}
