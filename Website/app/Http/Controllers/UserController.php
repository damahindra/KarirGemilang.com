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
        return response()->json(['user' => $user], 200);
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

    public function update($id, Request $request)
    {
        // Tulis disini banh
        $validatedData = $request->validate([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'birthdate' => $request->birthdate,
            'last_education' => $request->last_education,
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Update the user with the validated data
        $user->update($validatedData);
        return response()->json(['message' => 'User updated successfully.'], 200);
    }

    public function destroy($id)
    {
        // Find the job by its ID
        $user = User::findOrFail($id);

        // Delete the job
        $user->delete();

        // Return a response (you can customize this)
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
