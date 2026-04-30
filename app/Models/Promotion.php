<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'image',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
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
