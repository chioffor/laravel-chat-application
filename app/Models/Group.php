<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // protected $attributes = [
    //     'created_by' => [],
    //     'members' => [],
    // ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function isAdmin($id)
    {
        if ($this->users->first()->id === $id)
            return true;
        else
            return false;
    }

    
}
