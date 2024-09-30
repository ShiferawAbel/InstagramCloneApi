<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;

class ApiUserController extends Controller
{
    public function index(Request $request) {
        if ($request->input('followers')) {
            return new UserCollection(User::all()->load('followers'));;
        }
        return new UserCollection(User::all());;
    }

    public function show(User $user, Request $request) {
        $chat_common = null;
        
        foreach ($user->chats as $chat) {
            if ($chat->users->where('id', auth()->user()->id)->first()) {
                $chat_common = $chat->id;
                break;
            }
        }
        
        return [
            'user' => new UserResource($user),
            'chatCommon' => $chat_common,
        ];
    }
    
    public function register(RegisterRequest $request)
    {
        $request->validated();
        print($request->file('profileUrl'));
        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if(request()->hasfile('profile_url')){
            $user->profile_url = request()->file('profile_url')->store('profile', 'public');
        }
        $user->save();

        auth()->login($user);
        
        return [
            'message' => 'successfully created',
            'user' => auth()->user(),
        ];
    }
    
    public function follow(User $user) {
        $user->followers()->attach(auth()->user());
        $user->follower_number = $user->follower_number + 1;
        auth()->user()->following_number = auth()->user()->following_number + 1;
        auth()->user()->save();
        $user->save();
        
        return response('success');
    }
    
    public function unfollow(User $user) {
        $user->followers()->detach(auth()->user());
        $user->follower_number = $user->follower_number - 1;
        auth()->user()->following_number = auth()->user()->following_number - 1;
        auth()->user()->save();
        $user->save();
        
        return response('success');
    }
    
    public function auth_profile(Request $request) {
        if (auth()->check()) {

            if ($request->input('posts')) {
                $user = auth()->user();
                return [ 'user' => new UserResource($user->load('posts'))];
            }
            
            $user = auth()->user();
            return [ 'user' => new UserResource($user)];
        }
    }

}
