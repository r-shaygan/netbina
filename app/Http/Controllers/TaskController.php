<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks=Task::where('assigned',auth()->id())->get();

        return view('task.index',compact('tasks'));
    }

    public function create()
    {
        return view('task.create',['users'=>User::all()]);
    }

    public function store(TaskRequest $request)
    {
        Task::make($request->all()+['assigner'=>auth()->id(),
                'owner'=>auth()->id(),
                'status'=> $this->setStatus()
            ])->save();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        $this->authorize('isAssignedUser',$task);

        $users=User::all();

        return view('task.show',compact('task','users'));
    }

    public function accept(Task $task)
    {
        $this->authorize('canAccept',$task);

        $task->update(['status'=>1]);

        return redirect()->route('tasks.index');
    }

    public function assign(Task $task)
    {
        $this->authorize('canAssign',$task);

        $task->update([
            'assigned'=>\request('assigned'),
            'assigner'=>auth()->id()
            ]);

        return redirect()->route('tasks.index');
    }

    public function ownTasks()
    {
        $tasks=Task::where('owner',auth()->id())->get();

        return view('task.own-tasks',compact('tasks'));
    }

    public function edit(Task $task)
    {
        return view('task.edit',compact('task'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('canModify',$task);

        $task->update($request->all(['title','deadline','description']));

        return redirect()->route('tasks.own');
    }


    public function destroy(Task $task)
    {
        $this->authorize('canModify',$task);

        $task->delete();

        return redirect()->route('tasks.own');
    }

    private function setStatus():bool
    {
        return \request('assigned') === auth()->id();
    }

}
