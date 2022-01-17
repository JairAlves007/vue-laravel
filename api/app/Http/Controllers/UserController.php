<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTodoRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::with('todos')->get();

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $user->load('todos');
        
        return new UserResource($user);
    }

    public function store(User $user, FormTodoRequest $request) {
        $input = $request->validated();

        $todo = $user->todos()->create($input);

        return new TodoResource($todo);
    }
}
