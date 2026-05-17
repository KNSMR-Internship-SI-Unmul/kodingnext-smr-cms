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

    public function getMediaExtensionAttribute()
    {
        return strtolower(pathinfo($this->media, PATHINFO_EXTENSION));
    }

    /**
     * Checking is media is video.
     */
    public function getIsVideoAttribute()
    {
        return in_array($this->media_extension, ['mp4', 'webm', 'ogg']);
    }

    /**
     * Display url without "http/https" for clean UI
     */
    public function getDisplayUrlAttribute()
    {
        return str_replace(['http://', 'https://'], '', $this->project_url);
    }
}
