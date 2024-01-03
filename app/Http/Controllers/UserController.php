<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view("profile.profile", compact("user"));
    }

    public function update(Request $request, $id_user)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" =>
                "required|email|unique:users,email," . $id_user . ",id_user",
            "password" => "nullable|string|min:8",
        ]);

        $user = User::findOrFail($id_user);

        // Update name and email
        $user->update([
            "name" => $validated["name"],
            "email" => $validated["email"],
        ]);

        // Update password if provided
        if ($request->filled("password")) {
            $user->update([
                "password" => Hash::make($request->password),
            ]);
        }

        return redirect("/profile")->with(
            "success",
            "User profile updated successfully",
        );
    }
}
