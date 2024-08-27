<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function todos()
    {
        return $this->hasMany(todos::class);
    }
    
}
