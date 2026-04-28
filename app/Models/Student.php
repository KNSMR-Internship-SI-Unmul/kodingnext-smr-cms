<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 
        'school', 
        'phone_number', 
        'address', 
        'is_profile_complete',
        'user_id'
    ];

    protected static function booted()
    {
        static::saving(function ($student) {
            $student->is_profile_complete = !empty($student->name) && 
                                            !empty($student->school) && 
                                            !empty($student->phone_number) && 
                                            !empty($student->address);
        });
    }

    public function studentProjects()
    {
        return $this->hasMany(StudentProject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
