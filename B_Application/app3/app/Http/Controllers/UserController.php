<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = user::all();
        return view('users.index', compact('users'));
    }

    public function show(user $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(user $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, user $user)
    {
        $data = $request->validate([
            'nom'     => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'password'=> 'nullable|string|min:6|confirmed',
        ]);
        if ($data['password'] ?? false) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('users.index');
    }

    public function destroy(user $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
