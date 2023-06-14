<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission extends Model
{
    use HasFactory;

    public static function isAdmissionActive(): bool
    {
        $today = Carbon::now();
        $admission = Admission::where('is_active', 1)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->exists();

        return $admission;
    }
}
