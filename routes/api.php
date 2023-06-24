<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Informal\InformalEducation;
use App\Http\Controllers\API\DormitoryController;
use App\Http\Controllers\API\FormalEducationController;
use App\Http\Controllers\API\InformalEducationController;
use App\Http\Controllers\API\DormitoryController as APIDormitoryController;
use App\Http\Controllers\API\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/locations', function () {
    $json = file_get_contents('https://cakmalik.github.io/api-wilayah-indonesia/api/provinces.json');
    $data = json_decode($json, true);
    return $data;
});

// get city from province
Route::get('/locations/{id}/cities', function ($id) {
    $json = file_get_contents('https://cakmalik.github.io/api-wilayah-indonesia/api/regencies/' . $id . '.json');
    $data = json_decode($json, true);
    return $data;
});

// get district from city
Route::get('/locations/{id}/districts', function ($id) {
    $json = file_get_contents('https://cakmalik.github.io/api-wilayah-indonesia/api/districts/' . $id . '.json');
    $data = json_decode($json, true);
    return $data;
});

// get village from district
Route::get('/locations/{id}/villages', function ($id) {
    $json = file_get_contents('https://cakmalik.github.io/api-wilayah-indonesia/api/villages/' . $id . '.json');
    $data = json_decode($json, true);
    return $data;
});

Route::get('/informal_classes/{id}', [InformalEducationController::class, 'getInformalClassesFromInFormalEducation']);
Route::get('/formal_classes/{id}', [FormalEducationController::class, 'getFormalClassesFromFormalEducation']);
Route::get('/dormitories/by-student-gender/{student}', [DormitoryController::class, 'getDormitoriesByStudentGender']);
Route::get('/rooms/by-dormitory/{dormitory}', [RoomController::class, 'getRoomsByDormitory']);
