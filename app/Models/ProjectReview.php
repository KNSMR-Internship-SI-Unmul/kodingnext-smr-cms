<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectReview extends Model
{
    protected $fillable = [
        'review_content',
        'rating',
        'is_approved',
        'student_project_id'
    ];

    public function studentProject() 
    {
        return $this->belongsTo(StudentProject::class);
    }
}
