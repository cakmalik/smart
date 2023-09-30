<?php

namespace App\Models\Bakid;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InOutPermissionType extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value)
        );
    }

    public function getDurationAttribute($value)
    {
        $value = (int) $value;

        if ($value > 60) {
            $waktu = Carbon::now()->setTime(0, $value);
            $jam = $waktu->hour;
            $mnt = $waktu->minute;
            return $jam . ' jam ' . $mnt . ' mnt';
        } else {
            return $value . ' mnt';
        }
    }
}
