<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskStored(): void
    {
        $name = 'Test Task Store';
        $response = $this->post('/tasks', ['name' => $name]);
        $response->assertRedirect('/');
        $this->assertEquals($name, Task::find(1)->name);
    }

    public function testTaskPageLoads(): void
    {
        $name = 'Test Task Get';
        Task::factory()->create(['name' => $name]);
        $response = $this->get('/');
        $response->assertSee($name);

    }

    public function testTaskUpdated(): void
    {
        $flag = 1;
        $task = Task::factory()->create(['name' => 'Test Task Update']);
        $response = $this->patch('/tasks/' . $task->id, ['completed' => $flag]);
        $response->assertRedirect('/');
        $this->assertEquals($flag, Task::find($task->id)->completed);
    }

    public function testTaskDeleted(): void
    {
       $task = Task::factory()->create(['name' => 'Test Task Delete']);
       $response = $this->delete('/tasks/' . $task->id);
       $response->assertRedirect('/');;
       $this->assertNull(Task::find($task->id));
    }
}
