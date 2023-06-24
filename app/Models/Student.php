<?php

namespace App\Models;

use App\Models\User;
use App\Models\Bakid\Room;
use App\Models\StudentFamily;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Services\Location\LocationServiceImplement;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    // private $loc;

    // public function __construct(LocationService $locationService)
    // {
    //     parent::__construct();
    //     $loc = $locationService;
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => 'female' ? 'Perempuan' : 'Laki-laki',
            set: fn (string $value) => 'Perempuan' ? 'female' : 'male'
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
}
