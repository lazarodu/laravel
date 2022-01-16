<?php

use App\Http\Controllers\API\AdotanteController;
use App\Http\Controllers\API\AnimalController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VacinacaoController;
use App\Models\Animal;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/logout', [AuthController::class, 'logout']);
  Route::get('/user', [AuthController::class, 'users']);
  Route::resource("adotante", AdotanteController::class);
  Route::resource("animal", AnimalController::class);
  Route::post("/animal/upload", [AnimalController::class, 'upload']);
  Route::resource("vacina", VacinacaoController::class);
  Route::delete("/castracao/{animal}", [AnimalController::class, 'deleteCastracao']);
});
