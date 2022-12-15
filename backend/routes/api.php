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

   Route::get('/aulas/{codigo}',[AulaController::class, 'getAula'])->name('mobile.aulas.index');
   Route::get('/objetos3d/{codigo}', [Objeto3dController::class, 'getObjeto3d'])->name('mobile.objetos3d.show');
   Route::get('/objetos3d/{codigo}/download', [Objeto3dController::class, 'downloadObjeto3d'])->name('mobile.objetos3d.download');

});