    <?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\EventCategoryController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\GroupCellController;
use App\Http\Controllers\api\GroupCellHasMemberController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post("/v1/auth/login", [AuthController::class,"login"]);
});
    
Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/v1/auth/validate', [AuthController::class,"validateToken"]);
        // Route::post('logout', 'SianasAuthController@logout');
        // Route::post('change-password', 'SianasAuthController@changeStudentPassword');
    });
Route::controller(UserController::class)->group(function () {
    Route::post("/v1/users", "post");
    Route::get("/v1/users", "get");
    Route::get("/v1/users/{id}", "getById");

});

Route::controller(EventController::class)->group(function () {
    Route::post("/v1/events", "post");
    Route::get("/v1/events", "get");
    Route::get("/v1/event-list", "getList");
    Route::get("/v1/events/{id}", "getById");
    Route::put("/v1/events/{id}","put");
    Route::patch("/v1/events/{id}/status","toggleStatus");
    Route::delete("/v1/events/{id}", "delete");
});

Route::controller(EventCategoryController::class)->group(function () {
    Route::post("/v1/event-categories", "post");
    Route::get("/v1/event-categories", "get");
    Route::get("/v1/event-categories/{id}", "getById");
    Route::put("/v1/event-categories/{id}","put");
    Route::delete("/v1/event-categories/{id}", "delete");
});

Route::controller(ArticleController::class)->group(function () {
    Route::post("/v1/articles", "post");
    Route::get("/v1/articles", "get");
    Route::get("/v1/articles/{id}", "getById");
    Route::put("/v1/articles/{id}","put");
    Route::delete("/v1/articles/{id}", "delete");
});

Route::controller(GroupCellController::class)->group(function () {
    Route::post("/v1/group-cells", "post");
    Route::get("/v1/group-cells", "get");
    Route::get("/v1/group-cell-list", "getList");
    Route::get("/v1/group-cells/{id}", "getById");
    Route::put("/v1/group-cells/{id}","put");
    Route::delete("/v1/group-cells/{id}", "delete");
});

Route::controller(GroupCellHasMemberController::class)->group(function () {
    Route::post("/v1/group-cells/{groupCellId}/members", "post");
    Route::get("/v1/group-cells/{groupCellId}/members", "get");
    Route::delete("/v1/group-cell-members/{id}", "delete");
});
