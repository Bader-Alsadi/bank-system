<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccounTypeController;
use App\Http\Controllers\authContoller;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CurrncyController;
use App\Http\Controllers\TransctionController;
use App\Http\Controllers\TransctionTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//

Route::middleware(["auth:sanctum"])->group(function () {
    Route::post("/dopsit", [TransctionController::class, "dopsit"]);
    Route::post("/withdrow", [TransctionController::class, "withdrow"]);
    Route::post("/transform", [TransctionController::class, "transform"]);
    Route::post("/change_main_account", [UserController::class, "changeMainAccoubt"]);
});

//
Route::post("/login", [authContoller::class, "login"]);

//
Route::apiResources([
    "/bransh" => BranchController::class,
    "/account" => AccountController::class,
    "/accountType" => AccounTypeController::class,
    "/user" => UserController::class,
    "/trnasctionType" => TransctionTypeController::class,
    "/trnasction" => TransctionController::class,
    "/currncy" => CurrncyController::class


]);
