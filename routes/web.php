<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get("/dashboard", [DashboardController::class, "index"])->middleware(
    "auth",
);
Route::get("/", [DashboardController::class, "index"])->middleware("auth");

//route barang
Route::resource("/product", ProductController::class)->middleware("auth");

// Route::middleware("auth:sanctum")->group(function () {
//     Route::get("/profile", [UserController::class]);
//     Route::put("/user/update", [UserController::class, "update"]);
// });

Route::resource("/profile", UserController::class)
    ->only(["index", "update"])
    ->middleware("auth");
Route::put("/profile/{id_user}", [UserController::class, "update"])
    ->name("profile.update")
    ->middleware("auth");
