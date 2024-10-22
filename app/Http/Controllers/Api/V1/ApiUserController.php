<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;

use App\Http\Requests\UpdateProfileRequest;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('followers')) {
            return new UserCollection(User::all()->load('followers'));;
        }
        return new UserCollection(User::all());;
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        if ($request->hasFile('profile_url')) {

            $file = $request->file('profile_url');
            $path = $file->store('profile', 'public');
            $user = User::find(auth()->user()->id);
            $user->profile_url = $path;
            $user->save();
            return response()->json(['success' => 'Profile updated successfully', 'path' => $path]);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        // $user->profile_url = $request->file('profile_url')->store('profile', 'public');
    }

    public function show(User $user, Request $request)
    {
        $chat_common = null;

        foreach ($user->chats as $chat) {
            if ($chat->users->where('id', auth()->user()->id)->first()) {
                $chat_common = $chat->id;
                break;
            }
        }

        return [
            'user' => new UserResource($user->load(
                'posts',
                'followers.followers',
                'followers.following',
                'following.followers',
                'following.following'
            )),
            'chatCommon' => $chat_common,
        ];
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if (request()->hasfile('profile_url')) {
            $user->profile_url = $request->file('profile_url')->store('profile', 'public');
        }
        $user->save();

        auth()->login($user);

        return [
            'message' => 'successfully created',
            'user' => auth()->user(),
        ];
    }

    public function follow(User $user)
    {
        $user_already_follows = $user->followers()->where('follower_id', auth()->user()->id)->exists();
        print($user_already_follows);
        if (!$user_already_follows) {
            $user->followers()->attach(auth()->user());
            $user->follower_number = $user->follower_number + 1;
            auth()->user()->following_number = auth()->user()->following_number + 1;
            auth()->user()->save();
            $user->save();
    
            return response('success');
            # code...
        }
    }

    public function unfollow(User $user)
    {
        $user->followers()->detach(auth()->user());
        $user->follower_number = $user->follower_number - 1;
        auth()->user()->following_number = auth()->user()->following_number - 1;
        auth()->user()->save();
        $user->save();

        return response('success');
    }

    public function auth_profile(Request $request)
    {
        if (auth()->check()) {

            if ($request->input('posts')) {
                $user = User::find(auth()->user()->id);
                return ['user' => new UserResource($user->load('posts', 'followers.followers', 'followers.following', 'following.followers', 'following.following'))];
            }

            $user = auth()->user()->load('notes');
            return ['user' => new UserResource($user)];
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
        ]);
        return [
            $request
        ];
    }
}
