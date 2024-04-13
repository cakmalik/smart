<?php

namespace App\Models;

use App\Models\Student;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ReminderNotification;
use App\Models\Formal\FormalEducation;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Informal\InformalEducation;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserHasFormalEducationPermission;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\UserHasInformalEducationPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'kk', 'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function totalStudents()
    {
        return $this->students->count();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (String $value) => ucwords($value),
            set: fn (String $value) => strtolower($value)
        );
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function reminder()
    {
        return $this->hasOne(ReminderNotification::class);
    }

    public function educations()
    {
        return $this->belongsToMany(InformalEducation::class, 'user_has_informal_education_permission', 'user_id', 'education_id');
    }

    public function InformalEducations()
    {
        return $this->belongsToMany(InformalEducation::class, 'user_has_informal_education_permission', 'user_id', 'education_id');
    }

    public function formalEducations()
    {
        return $this->belongsToMany(FormalEducation::class, 'user_has_formal_education_permission', 'user_id', 'education_id');
    }
}