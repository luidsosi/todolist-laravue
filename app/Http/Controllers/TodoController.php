<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Todo::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $todo = Todo::create($request->all());
        return response()->json($todo);
    }

    public function show(Todo $todo)
    {
        //
    }

    public function edit(Todo $todo)
    {
        //
    }

    public function update(Request $request, Todo $todo): JsonResponse
    {
        $todo->name = $request->name;
        $todo->save();
        return response()->json($todo);
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();
        return response()->json(['result' => 'success']);
    }
}
