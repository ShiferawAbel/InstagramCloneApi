<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user) {
        $posts = $user->posts;

        return view('user.show', compact('posts', 'user'));
    }
    public function create() {
        return view('user/create');
    }

    public function store() {
        $form_data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'user_name' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);
        if(request()->hasfile('profile_url')){
            $form_data['profile_url'] = request()->file('profile_url')->store('profile', 'public');
        }
        $form_data['password'] = bcrypt($form_data['password']);
        $user = User::create($form_data);

        auth()->login($user);

        return redirect('/');
    }

    public function login_create() {
        return view('user.login');
    }

    public function login(Request $request) {
        $form_data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($form_data)) {
            $request->session()->regenerate();
            
            return redirect('/');
        }

        return back()->withErrors('invalid credentials');
    }

    public function logout(Request $request) {
        auth()->logout();
        session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function findfriends() {
        $users = User::all();
        
        return view('user.findfriends', compact('users'));
    }

    public function follow(User $user) {
        $user->followers()->attach(auth()->user());
        $user->follower_number = $user->follower_number + 1;
        $user->save();
        auth()->user()->following_number = auth()->user()->following_number + 1;
        auth()->user()->save();
        return back();
    }

    // public function unfollow(User $user) {
    //     $conn = ;
    // }
}
