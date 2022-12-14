<?php

namespace Tests\Feature\Task;


use App\Models\Task;
use App\Models\User;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotTrue;

class TaskCreationTest extends TestCase
{

    public function test_task_save_in_database()
    {
        $lastTaskIdBeforeInsert=Task::orderby('id','desc')->first() ? Task::orderby('id','desc')->first()->id : 0 ;

        $this->actingAs(User::find(1));

        $task=Task::factory()->raw();

        $this->post('/tasks',$task)->assertRedirect();

        $lastTaskIdAfterInsert=Task::orderby('id','desc')->first()->id;

        assertNotTrue($lastTaskIdAfterInsert===$lastTaskIdBeforeInsert);

        $this->assertDatabaseHas('tasks', [
            'id'=>$lastTaskIdAfterInsert,
            'title'=>$task['title'],
            'deadline'=>date('Y-m-d H:i:00',strtotime($task['deadline']))
        ]);

    }

    public function test_status_if_user_assigned_themselves()
    {
        $lastTaskIdBeforeInsert=Task::orderby('id','desc')->first() ? Task::orderby('id','desc')->first()->id : 0 ;

        $this->actingAs(User::find(1));

        $task=Task::factory()->raw(['assigned'=>1]);

        $this->post('/tasks',$task)->assertRedirect();

        $lastTaskIdAfterInsert=Task::orderby('id','desc')->first()->id;

        assertNotTrue($lastTaskIdAfterInsert===$lastTaskIdBeforeInsert);


        $this->assertDatabaseHas('tasks', [
            'id'=>$lastTaskIdAfterInsert,
            'status'=>1,
            'title'=>$task['title'],
            'deadline'=>date('Y-m-d H:i:00',strtotime($task['deadline']))
        ]);
    }

    public function test_task_title_validation()
    {
        $this->actingAs(User::find(1));

        $task = Task::factory()->raw(['title'=>'']);

        $this->post('/tasks',$task)->assertSessionHasErrors('title');

        $task = Task::factory()->raw(['title'=>'k']);

        $this->post('/tasks',$task)->assertSessionHasErrors('title');
    }

    public function test_task_deadline_validation()
    {
        $this->actingAs(User::find(1));

        $task = Task::factory()->raw(['deadline'=>'']);

        $this->post('/tasks',$task)->assertSessionHasErrors('deadline');

        $task = Task::factory()->raw(['deadline'=>date('Y-m-d H:i:00',time())]);

        $this->post('/tasks',$task)->assertSessionHasErrors('deadline');
    }

    public function test_task_assign_validation()
    {
        $this->actingAs(User::find(1));

        $task = Task::factory()->raw(['assigned'=>0]);

        $this->post('/tasks',$task)->assertSessionHasErrors('assigned');
    }

}
