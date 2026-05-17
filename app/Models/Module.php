<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'age_range',
        'duration_per_session',
        'category',
        'course_type_id'
    ];

    public function courseType() 
    {
        return $this->belongsTo(CourseType::class);
    }

    public function studentProjects()
    {
        return $this->hasMany(StudentProject::class);
    }

    public function getBadgeColorAttribute()
    {
        $courseName = strtolower($this->courseType->name ?? '');
        
        if (str_contains($courseName, 'junior')) {
            return 'bg-brand-light-blue-active/75 text-brand-blue';
        } elseif (str_contains($courseName, 'little')) {
            return 'bg-brand-light-pink-active/75 text-brand-pink';
        } elseif (str_contains($courseName, 'robo')) {
            return 'bg-brand-light-purple-active/75 text-brand-purple';
        } 
        
        return 'bg-gray-100 text-gray-700';
    }

    public function getThemeAttribute()
    {
        $themes = [
            1 => [
                'bg' => 'bg-brand-light-pink',
                'text' => 'text-brand-pink',
                'border' => 'border-brand-pink',
                'primary' => 'bg-brand-pink',
            ],
            2 => [
                'bg' => 'bg-brand-light-blue',
                'text' => 'text-brand-blue',
                'border' => 'border-brand-blue',
                'primary' => 'bg-brand-blue',
            ],
            3 => [
                'bg' => 'bg-brand-light-purple',
                'text' => 'text-brand-purple/75',
                'border' => 'border-brand-purple/75',
                'primary' => 'bg-brand-purple',
            ],
        ];

        return $themes[$this->course_type_id] ?? [
            'bg' => 'bg-gray-100',
            'text' => 'text-gray-700',
            'border' => 'border-gray-300',
            'primary' => 'bg-gray-500',
        ];
    }
}
