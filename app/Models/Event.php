<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'event_date',
        'description',
        'image',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
