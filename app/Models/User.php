<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'profile_picture',
        'hired_date',
        'role_id'
    ];

    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    public function students() 
    {
        return $this->hasMany(Student::class);
    }

    public function courseTypes() 
    {
        return $this->hasMany(CourseType::class);
    }

    public function events() 
    {
        return $this->hasMany(Event::class);
    }

    public function promotions() 
    {
        return $this->hasMany(Promotion::class);
    }

    public function generalTestimonials() 
    {
        return $this->hasMany(GeneralTestimonial::class);
    }

    public function getShortNameAttribute()
    {
        return Str::limit($this->name, 15);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'hired_date' => 'date',
        ];
    }
}
