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

    public function getStatusLabelAttribute()
    {
        $today = now()->format('Y-m-d');
        $startDate = $this->start_date->format('Y-m-d');
        $endDate = $this->end_date->format('Y-m-d');

        if ($today < $startDate) {
            return 'Upcoming';
        } elseif ($today > $endDate) {
            return 'Done';
        }

        return 'On Going';
    }

    public function getStatusColorAttribute()
    {
        switch ($this->status_label) {
            case 'Upcoming':
                return 'bg-yellow-100 text-yellow-600 border-yellow-300';
            case 'Done':
                return 'bg-gray-100 text-gray-500 border-gray-300';
            default:
                return 'bg-green-100 text-green-600 border-green-200';
        }
    }

}
