<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskAcceptanceTest extends TestCase
{

    public function test_user_can_not_accept_others_pending_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'assigned'=>22,
            'owner'=>1,
            'assigner'=>1]);

        $this->get("/tasks/accept/{$task->id}")->assertStatus(403);
    }

    public function test_user_can_not_accept_accepted_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'assigned'=>1,
            'owner'=>22,
            'assigner'=>22,
            'status'=>1]);

        $this->get("/tasks/accept/{$task->id}")->assertStatus(403);
    }

    public function test_user_can_not_accept_delayed_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'owner'=>22,
            'assigner'=>22,
            'deadline'=>date('d-m-Y H:i:s',time()-1)]);

        $this->get("/tasks/accept/{$task->id}")->assertStatus(403);
    }

    public function test_user_can_accept_their_pending_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'assigned'=>1,
            'owner'=>22,
            'assigner'=>22]);

        $this->get("/tasks/accept/{$task->id}")->assertRedirect();

        $this->assertDatabaseHas('tasks',[
            'id'=>$task->id,
            'status'=>1
            ]);
    }

}
