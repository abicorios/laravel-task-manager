<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function setRole(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'role' => 'required|string|in:ADMIN,USER',
        ]);

        $user = User::findOrFail($id);
        $user->role = $validatedData['role'];
        $user->save();

        return response()->json(['message' => 'Role updated successfully']);
    }
}
