<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getTime()
    {
        return $this->created_at->format('H:i');
    }

    public function direct()
    {
        return $this->belongsTo(Direct::class);
    }

    
}
