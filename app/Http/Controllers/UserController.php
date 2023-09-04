<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

session_start();

class UserController extends Controller
{
    // showing all users
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('users.index', compact('users'));
    }
    //-----------------------------------------------------------------------//

    // create user
    public function create()
    {
        return view('users.create');
    }

    //------------------------------------------------------------------------//

    // storing users to DB
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect('/users');
    }
    //-----------------------------------------------------------------------//

    //Edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //-----------------------------------------------------------------------//
    //Update user
    public function update(Request $request, User $user)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Update the user's data
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // redirect after successfull updating
        return redirect()->route('users.index');
    }

    //-----------------------------------------------------------------------//

    // Destroy user
    public function destroy(User $user)
    {
        $user->delete();

        // Optionally, you can add a flash message to indicate successful deletion
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
