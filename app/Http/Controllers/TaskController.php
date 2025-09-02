<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = \App\Models\Task::query()->orderByDesc('id');

        if (request()->filled('user_id')) {
            $q->where('user_id', request('user_id'));
        }

        return response()->json($q->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required','integer'],
            'title'   => ['required','string','max:255'],
            'done'    => ['boolean'],
        ]);

        $task = \App\Models\Task::create([
            'user_id' => $data['user_id'],
            'title'   => $data['title'],
            'done'    => $data['done'] ?? false,
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['sometimes','required','string','max:255'],
            'done'  => ['sometimes','boolean'],
        ]);

        $task->update($data);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['deleted' => true]);
    }
}
