<?php

use Carbon\Carbon;
use App\Models\Admission;


function isCanAdmission(): bool
{
    return Admission::isAdmissionActive();
}
