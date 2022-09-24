<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\
{
   RegisterController,
   DisciplineController,
   AugumentedObjectController,
   RoomController
};

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {

   Route::apiResources([
      'disciplines' => DisciplineController::class,
      'augumented_objects' => AugumentedObjectController::class,
      'rooms' => RoomController::class,
   ]);

   Route::get('augumented_objects/{augumented_object}/download', [AugumentedObjectController::class, 'download'])->name('augumented_objects.download');

});
