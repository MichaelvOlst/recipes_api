<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'device_name' => 'required',
        ]);

        $user = User::create($attributes);

        $token = $user->createToken($request->device_name);

        return response([
            'token' => $token->plainTextToken
        ], 201);
    }
}
