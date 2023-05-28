<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    // https://cakmalik.github.io/api-wilayah-indonesia/api/provinces.json
    $json = file_get_contents('https://cakmalik.github.io/api-wilayah-indonesia/api/provinces.json');
    $data = json_decode($json, true);
    return $data;
});
