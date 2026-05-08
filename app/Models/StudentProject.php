<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'media',
        'project_url',
        'is_published',
        'module_id',
        'student_id'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function module() 
    {
        return $this->belongsTo(Module::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function projectReview()
    {
        return $this->hasOne(ProjectReview::class);
    }
}
