<?php

namespace App\Services\Approval;

use Illuminate\Support\Collection;

interface ApprovalService
{

    function asrama($request): Collection;
}
