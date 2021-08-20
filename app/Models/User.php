<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        //'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id')->withPivot('unreadCount','favorite');
    }

    public function favorites()
    {
        return $this->belongsToMany(Group::class)->withPivot('unreadCount', 'favorite')->wherePivot('favorite', true);
    }

    public function activeFavorite($id)
    {
        return $this->favorites->firstWhere('id', '=', $id);
    }

    public function directs()
    {
        return $this->belongsToMany(Direct::class)->withPivot('unreadCount', 'favorite');
    }

    //
    // public function friends()
    // {
    //     return $this->belongsToMany(User::class, 'directs', 'user_id', 'friend_id');
    // }
}
