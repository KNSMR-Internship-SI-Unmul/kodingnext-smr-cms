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
        // 'category',
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
}
