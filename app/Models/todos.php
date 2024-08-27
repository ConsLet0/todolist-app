<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todos extends Model
{
    public function categories()
    {
        return $this->belongsTo(categories::class);
    }
    
    protected $table = 'todos';
    protected $fillable = [
        'categories_id',
        'title',
        'due_date',
        'is_finished',
    ];
}
