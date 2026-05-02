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

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    public function getFileFormatAttribute()
    {
        if (!$this->image) {
            return '-';
        }
        return strtoupper(pathinfo($this->image, PATHINFO_EXTENSION));
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
