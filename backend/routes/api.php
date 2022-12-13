<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\
{
   RegisterController,
   DisciplinaController,
   Objeto3dController,
   AulaController
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
      'disciplinas' => DisciplinaController::class,
      'objetos3d' => Objeto3dController::class,
      'aulas' => AulaController::class,
   ]);

   Route::get('objetos3d/{objeto_3d}/download', [Objeto3dController::class, 'download'])->name('objetos3d.download');

});

//API ROUTES FOR APP MOBILE

Route::prefix('mobile')->group(function () {

   Route::get('/aulas/{aula_id}/objetos3d',[Objeto3dController::class, 'index']);
   Route::get('/objetos3d/{objeto_3d}', [Objeto3dController::class, 'show']);
   Route::get('/objetos3d/{objeto_3d}/download', [Objeto3dController::class, 'download'])->name('objetos3d.download');

});