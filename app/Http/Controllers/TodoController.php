<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Requests\UpdateTodoViewsCountRequest;

use App\Models\Todo;
use Illuminate\Http\Response;

/**
 * @method hasOne(string $class)
 * @method belongsTo(string $class)
 */
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Todo::orderBy('created_at','DESC')
            ->with('user','project')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTodoRequest $request
     * @return Response
     */
    public function store(StoreTodoRequest $request)
    {
        return Todo::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return Response|Todo
     */
    public function show(Todo $todo): Response|Todo
    {
        return $todo->load('user');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param Todo $todo
     * @return Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoRequest  $request
     * @param Todo $todo
     * @return Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->all());
        return $todo->load('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return $todo->load('user');
    }
    public function updateViews(UpdateTodoViewsCountRequest $request,Todo $todo)
    {
        $todo->views_count++;
        $todo->save();
        return $todo->load('user');
    }
}
