<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\
{
   RegisterController,
   DisciplineController,
   AugmentedObjectController,
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
      'augmented_objects' => AugmentedObjectController::class,
      'rooms' => RoomController::class,
   ]);

   Route::get('augmented_objects/{augmented_object}/download', [AugmentedObjectController::class, 'download'])->name('augmented_objects.download');

});