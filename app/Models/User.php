<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Chat;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_name',
        'profile_url',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
    
    public function followers() {
        return $this->belongsToMany(User::class, 'follower_user','user_id', 'follower_id');
    }
    
    public function following() {
        return $this->belongsToMany(User::class, 'follower_user','follower_id', 'user_id');
    }

    public function chats() {
        return $this->belongsToMany(Chat::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function liked_posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
