<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Tests\TestCase;

class TaskAuthorizationTest extends TestCase
{
    public function test_gust_can_not_access_tasks()
    {
        $response = $this->get('/tasks');

        $response->assertRedirect();
    }

    public function test_auth_can_access_tasks()
    {
        $this->actingAs(User::find(1));

        $response = $this->get('/tasks');

        $response->assertOk();
    }


}
