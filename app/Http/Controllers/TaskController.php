<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }


    public function store(StoreTaskRequest $request)
    {
        Task::create(['name' => $request->name]);
        return redirect()->route('tasks.index')->with('message', 'Task added successfully');
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->completed = $request->completed;
        $task->save();
        return redirect()->route('tasks.index')->with('message', 'Task marked as complete');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('message', 'Task successfully deleted');
    }
}
