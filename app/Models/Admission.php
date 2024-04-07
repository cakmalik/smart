<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function isThereActiveAdmission(): bool
    {
        $today = Carbon::now();
        $admission = Admission::where('is_active', 1)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->exists();

        return $admission;
    }

    public static function getActiveAdmission(){
        $today = Carbon::now();
        $admission = Admission::where('is_active', 1)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();
        return $admission;
    }
}