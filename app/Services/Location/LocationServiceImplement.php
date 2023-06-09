<?php

namespace App\Services\Location;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Http;
use App\Repositories\Location\LocationRepository;

class LocationServiceImplement extends Service implements LocationService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */

    public function getProvinceName($locationId)
    {
        $response = Http::get("https://cakmalik.github.io/api-wilayah-indonesia/api/provinces.json");

        if ($response->successful()) {
            $provinces = $response->json();

            $filteredProvince = array_filter($provinces, function ($province) use ($locationId) {
                return $province['id'] == $locationId;
            });

            if (!empty($filteredProvince)) {
                $province = reset($filteredProvince);
                $provinceName = strtolower($province['name']);
                return $provinceName;
            }
        }

        return null;
    }

    public function getCityName($locationId)
    {
        $response = Http::get("https://cakmalik.github.io/api-wilayah-indonesia/api/regency/{$locationId}.json");
        if ($response->successful()) {
            return strtolower($response->json()['name']);
        }
    }

    public function getDistrictName($locationId)
    {
        $response = Http::get("https://cakmalik.github.io/api-wilayah-indonesia/api/district/{$locationId}.json");
        if ($response->successful()) {
            return strtolower($response->json()['name']);
        }
    }

    public function getVillageName($locationId)
    {
        $response = Http::get("https://cakmalik.github.io/api-wilayah-indonesia/api/village/{$locationId}.json");
        if ($response->successful()) {
            return strtolower($response->json()['name']);
        }
    }
}
