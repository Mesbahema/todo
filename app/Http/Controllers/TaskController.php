<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskStoreRequest;
use App\Jobs\SendEmailJob;
use App\Models\Task;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('user')->orderBy('created_at', 'desc')->get();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(taskStoreRequest $request)
    {
        Auth::user()->tasks()->create($request->except('_token'));
        SendEmailJob::dispatch(Auth::user());
        return redirect('/task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task->load('user');
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $response = \Gate::allows('edit-task', $task);
        if ($response) {
            return view('task.edit', compact('task'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(taskStoreRequest $request, Task $task)
    {

        $task->update($request->except('_token'));

        return $this->index();
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $tasks = Task::with('user')->where('title', 'like', '%'. $search . '%')->orderBy('created_at', 'desc')->get();
        return view('task.index', compact('tasks'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     */
    public function destroy(Task $task)
    {
        $response = \Gate::allows('edit-task', $task);
        if ($response) {
            $task->delete();
            return redirect('/task');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }


}
