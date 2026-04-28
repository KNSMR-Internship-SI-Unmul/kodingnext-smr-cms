<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralTestimonial extends Model
{
    protected $fillable = [
        'parents_name',
        'review_content',
        'is_published',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
