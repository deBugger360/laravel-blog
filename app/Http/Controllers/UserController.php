<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    // Show the user registration form
    public function create() {
        return view('admin.users.register');     
    }

    //store new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_avatar' => 'image|mimes:jpeg,png,jpg,gif|max:1048576',
            'password' => 'required|string|min:8|confirmed',
        ]);

         if($request->hasFile('user_avatar')) {

            // store the image in public storage
            $formFields["user_avatar"] = $request->file("user_avatar")->store("avatars", "public");
        }

        // Hash the password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create the user
        $user = User::create($formFields);

        // // Login user
        // auth()->login($user);

        return redirect('/admin/users/show')->with('success', 'User created successfully!'); 
    }

    //user edit form
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

  
    // update user details
    public function update(Request $request, $id) {
        // dd($id);

        $user = User::findOrFail($id);

        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'user_avatar' => 'image|mimes:jpeg,png,jpg,gif|max:1048576',
        ]);

        if ($request->hasFile('user_avatar')) {
            // Get the existing image path
            $existingImagePath = $user->user_avatar;

            // Store the new image
            // Delete the existing image
            if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
                Storage::disk('public')->delete($existingImagePath);
            }

            $formFields["user_avatar"] = $request->file("user_avatar")->store("avatars", "public");
        }

        $user->update($formFields);

        return redirect('/admin/users/show')->with('success', 'User updated successfully!');
    }

    // update user password
    public function updatePassword(Request $request, $id) {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/admin/users/show')->with('success', 'Password updated successfully!');
    }

    //authenticate user login
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('success', 'Welcome, '. auth()->user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    //logout user
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('message', 'You have been logged out!');
    }

}
 