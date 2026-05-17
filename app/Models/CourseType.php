<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function getThemeAttribute()
    {
        $courseName = strtolower($this->name);
        
        $theme = [
            'color' => 'gray-600',
            'bg' => 'gray-100',
            'defaultImage' => 'images/default-course.avif' // Gambar cadangan umum
        ];

        if (str_contains($courseName, 'junior')) {
            $theme['color'] = 'brand-blue';
            $theme['bg'] = 'brand-light-blue';
            $theme['defaultImage'] = 'images/course-juniorkoder.avif';
        } elseif (str_contains($courseName, 'little')) {
            $theme['color'] = 'brand-pink';
            $theme['bg'] = 'brand-light-pink';
            $theme['defaultImage'] = 'images/course-littlekoder.avif';
        } elseif (str_contains($courseName, 'robo')) {
            $theme['color'] = 'brand-purple/75';
            $theme['bg'] = 'brand-light-purple';
            $theme['defaultImage'] = 'images/course-robonext.avif';
        }

        $theme['imagePath'] = $this->image ? asset('storage/' . $this->image) : asset($theme['defaultImage']);
        
        $theme['description'] = $this->description ?? 'Deskripsi untuk ' . $this->name . ' belum tersedia.';

        return $theme;
    }
}
