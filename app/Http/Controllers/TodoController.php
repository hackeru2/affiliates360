<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Requests\UpdateTodoViewsCountRequest;

use App\Models\Todo;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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
        return Todo::create($request->all())->load('user','project');
    }


    public function show(Todo $todo): Response|Todo|Collection
    {
        return $todo->load('user','project');
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


    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->all());
        return $todo->load('user','project');
    }

    public function destroy(Todo $todo): Todo
    {
        $todo->delete();
        return $todo->load('user','project');
    }
    public function updateViews(UpdateTodoViewsCountRequest $request,Todo $todo): Todo
    {
        $todo->views_count++;
        $todo->save();
        return $todo->load('user','project') ;
    }
}
