<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    // protected $primaryKey = 'uniqueID';

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_member', 'member_id', 'group_id');
    }
}
