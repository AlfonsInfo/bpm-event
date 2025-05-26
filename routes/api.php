<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\EventCategoryController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;
Route::controller(AuthController::class)->group(function () {
    Route::post("/v1/login", [AuthController::class,"login"]);
});
    

Route::controller(UserController::class)->group(function () {
    Route::post("/v1/users", "post");
    Route::get("/v1/users", "get");

});


Route::controller(EventController::class)->group(function () {
    Route::post("/v1/events", "post");
    Route::get("/v1/events", "get");
    Route::get("/v1/events/{id}", "getById");
    Route::put("/v1/events/{id}","put");
    Route::delete("/v1/events/{id}", "delete");
});

Route::controller(EventCategoryController::class)->group(function () {
    Route::post("/v1/event-categories", "post");
    Route::get("/v1/event-categories", "get");
    Route::get("/v1/event-categories/{id}", "getById");
    Route::put("/v1/event-categories/{id}","put");
    Route::delete("/v1/event-categories/{id}", "delete");
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
