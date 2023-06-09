<?php

namespace App\Services\Location;

use LaravelEasyRepository\BaseService;

interface LocationService extends BaseService
{
    public function getProvinceName($locationId);

    public function getCityName($locationId);

    public function getDistrictName($locationId);

    public function getVillageName($locationId);
}
