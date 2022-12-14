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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function setStatus():bool
    {
        return \request('assigned') === auth()->id();
    }

}
