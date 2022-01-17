<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function markAsDone(Todo $todo)
    {
        $todo->is_done = true;

        $todo->save();

        return new TodoResource($todo);
    }

    public function markAsUndone(Todo $todo)
    {
        $todo->is_done = false;

        $todo->save();

        return new TodoResource($todo);
    }
}
