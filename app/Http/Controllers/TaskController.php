<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use \Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks', ['tasks' => Task::all()]);
    }


    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create(['name' => $request->name]);
        return redirect()->route('tasks.index')->with('message', 'Task added successfully');
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->fill($request->validated());
        $task->save();
        return redirect()->route('tasks.index')->with('message', 'Task marked as complete');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('message', 'Task successfully deleted');
    }
}
