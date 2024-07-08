<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::where('user_id', $id)->get();
        // return error if empty
        if ($user->isEmpty()) {
            return response()->json(['error' => 'User not found'], 404);
        }
        // return user on success
        return response()->json($user);
    }

    public function create(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|min:12',
            'birthdate' => 'required|date',
            'last_education' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Create the new user
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'birthdate' => $request->birthdate,
            'last_education' => $request->last_education,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully!',
            'user' => $user,
        ], 201);
    }

    // public function store(Request $request)
    // {
    //     User::create($request->all());
    //     return redirect()->route('users.index');
    // }

    // public function show(User $user)
    // {
    //     return view('users.show', compact('user'));
    // }

    // public function edit(User $user)
    // {
    //     return view('users.edit', compact('user'));
    // }

    // public function update(Request $request, User $user)
    // {
    //     $user->update($request->all());
    //     return redirect()->route('users.index');
    // }

    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('users.index');
    // }
}
