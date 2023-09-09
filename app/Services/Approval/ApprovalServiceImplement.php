<?php

namespace App\Services\Approval;

use Illuminate\Support\Collection;
use LaravelEasyRepository\Service;
use App\Models\Student\RoomStudent;
use App\Repositories\Approval\ApprovalRepository;

class ApprovalServiceImplement  implements ApprovalService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  function asrama($request): Collection
  {
    return RoomStudent::where('status', 'waiting')->get();
  }
}
