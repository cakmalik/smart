<?php

namespace App\Models;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Bakid\Room;
use App\Models\StudentFamily;
use App\Models\Bakid\Dormitory;
use App\Models\Scopes\GenderScope;
use App\Models\Student\RoomStudent;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student\FormalEducationStudent;
use App\Models\Student\InformalEducationStudent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Services\Location\LocationServiceImplement;
use App\Models\Student\StudentEducationalBackground;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected static function booted(): void
    {
        static::addGlobalScope(new GenderScope);
    }

    use HasFactory;
    protected $guarded = [];
    // protected $primaryKey = 'nis';
    // private $loc;

    // public function __construct(LocationService $locationService)
    // {
    //     parent::__construct();
    //     $loc = $locationService;
    // }
    // public function getRouteKeyName()
    // {
    //     return 'nis';
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value === 'female' ? 'Perempuan' : 'Laki-laki',
            set: fn (string $value) => $value === 'Perempuan' ? 'female' : 'male'
        );
    }

    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) =>  date('Y-m-d', strtotime($value))
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (String $value) => ucwords($value),
            set: fn (String $value) => strtolower($value)
        );
    }

    protected function province(): Attribute
    {
        $loc = new LocationServiceImplement();
        return Attribute::make(
            get: fn (string $value) => is_numeric($value) ? ucwords($value) : $value,
            set: fn (string $value) => is_numeric($value) ? $loc->getProvinceName($value) : $value
        );
    }

    protected function city(): Attribute
    {
        $loc = new LocationServiceImplement();
        return Attribute::make(
            get: fn (string $value) => is_numeric($value) ? ucwords($value) : $value,
            set: fn (string $value) => is_numeric($value) ? $loc->getCityName($value) : $value
        );
    }

    protected function district(): Attribute
    {
        $loc = new LocationServiceImplement();
        return Attribute::make(
            get: fn (string $value) => is_numeric($value) ? ucwords($value) : $value,
            set: fn (string $value) => is_numeric($value) ? $loc->getDistrictName($value) : $value
        );
    }

    protected function village(): Attribute
    {
        $loc = new LocationServiceImplement();
        return Attribute::make(
            get: fn (string $value) => is_numeric($value) ? ucwords($value) : $value,
            set: fn (string $value) => is_numeric($value) ? $loc->getVillageName($value) : $value
        );
    }


    public function setNicknameAttribute($value)
    {
        $namaLengkap = $this->attributes['name'];

        if (empty($value) && !empty($namaLengkap)) {
            $namaPanggilan = explode(' ', $namaLengkap)[0];
            $this->attributes['nickname'] = $namaPanggilan;
        } else {
            $this->attributes['nickname'] = strtolower($value);
        }
    }

    public function parent()
    {
        return $this->belongsTo(StudentFamily::class, 'student_family_id');
    }

    public function room()
    {
        return $this->belongsToMany(Room::class, 'room_students');
    }

    public function dormitory()
    {
        return $this->belongsToMany(Dormitory::class, 'room_students');
    }

    public function getAsramaName()
    {
        return $this->dormitory[0]->name . '-' . $this->room[0]->name;
    }

    public function getFormalName()
    {
        return $this->formal?->lembaga->name . '-' . $this->formal?->kelas->class_name;
    }

    public function getInformalName()
    {
        return $this->informal?->lembaga->name . '-' . $this->informal?->kelas->class_name;
    }

    public function educationBackground()
    {
        return $this->hasMany(StudentEducationalBackground::class);
    }

    public function dormitories()
    {
        return $this->belongsToMany(Dormitory::class, 'room_students', 'student_id', 'dormitory_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getTotalStudentsAttribute()
    {
        return $this->user->totalStudents();
    }

    function scopeSantri($query)
    {
        return $query->whereNotNull('verified_at')->whereNull('drop_out_at');
    }

    function scopeAlumni($query)
    {
        return $query->whereNotNull('verified_at')->whereNotNull('drop_out_at');
    }

    public function formal()
    {
        return $this->hasOne(FormalEducationStudent::class, 'student_id');
    }

    public function informal()
    {
        return $this->hasOne(InformalEducationStudent::class, 'student_id');
    }
}