<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskDisplayTest extends TestCase
{

    public function test_user_can_see_their_assigned_tasks()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create(['owner'=>1,'assigner'=>1,'assigned'=>1]);

        $this->get('tasks')->assertSeeText($task->title);

        $this->get('tasks/'.$task->id)->assertSeeText($task->title);
    }

    public function test_user_can_not_see_other_users_tasks()
    {
        $user= User::factory()->create();

        $this->actingAs($user);

        $task=Task::factory()->create(['owner'=>$user->id,'assigner'=>1,'assigned'=>1]);

        $this->get('/tasks/'.$task->id)->assertStatus(403);

    }

}
