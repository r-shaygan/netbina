<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskAssignmentTest extends TestCase
{

    public function test_user_can_not_assign_others_pending_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'assigned'=>22,
            'owner'=>1,
            'assigner'=>1]);

        $this->post("/tasks/assign/{$task->id}",['assigned'=>23])->assertStatus(403);
    }

    public function test_user_can_not_assign_accepted_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'assigned'=>1,
            'owner'=>22,
            'assigner'=>22,
            'status'=>1]);

        $this->post("/tasks/assign/{$task->id}",['assigned'=>23])->assertStatus(403);
    }

    public function test_user_can_not_assign_delayed_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'owner'=>22,
            'assigner'=>22,
            'deadline'=>date('d-m-Y H:i:s',time()-1)]);

        $this->post("/tasks/assign/{$task->id}",['assigned'=>23])->assertStatus(403);
    }

    public function test_user_can_assign_their_pending_task()
    {
        $this->actingAs(User::find(1));

        $task=Task::factory()->create([
            'assigned'=>1,
            'owner'=>22,
            'assigner'=>22]);

        $this->post("/tasks/assign/{$task->id}",['assigned'=>23])->assertRedirect();

        $this->assertDatabaseHas('tasks',[
            'id'=>$task->id,
            'status'=>0,
            'assigned'=>23
            ]);
    }

}
