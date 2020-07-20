<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Session;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view("tasks.index")->with(['tasks' => Task::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'label' => 'required|string',
            'descrip' => 'nullable|string',
            'completed' => 'nullable|boolean'
        ]);

        $task = new Task();
        $task->name = $validated['name'];
        $task->due_date = $validated['due_date'];
        $task->description = $validated['descrip'];
        $task->label = $validated['label'];
        if (empty($validated['completed'])) {
            $task->completed = 0;
        } else {
            $task->completed = $validated['completed'];
        }
        $task->save();
        Session::flash('success', true);
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $color_tags = ['Black', 'Red','Blue', 'Yellow', 'Orange', 'Green', 'Purple'];

        return view('tasks.edit')->with(compact('task'))->with('colors',$color_tags);
//            [$task,$color_tags];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Task $task)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'label' => 'required|string',
            'descrip' => 'nullable|string',
            'completed' => 'nullable|boolean'
        ]);

        $old_task = Task::find($task->id);

        $old_task->name = $validated['name'];
        $old_task ->due_date = $validated['due_date'];
        $old_task ->description = $validated['descrip'];
        $old_task ->label = $validated['label'];
        if (empty($validated['completed'])) {
            $old_task->completed = 0;
        } else {
            $old_task->completed = $validated['completed'];
        }
        $old_task->save();
        Session::flash('status', 'Task was successfully updated');
        return redirect(route('tasks.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Task::find($task->id)->delete();
        return(redirect(route('tasks.index')));
    }
}
