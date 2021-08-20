<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direct extends Model
{
    use HasFactory;


    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('unreadCount', 'favorite');
    }

    public function friend($id)
    {
        return $this->users->except([$id])->first();
        //return User::find($this->friend_id);
    }
    
   
}
