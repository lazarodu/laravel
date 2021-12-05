<?php

use App\Http\Controllers\Initial\InicioController;
use App\Http\Controllers\AdotanteController;
use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InicioController::class, "index"]);
Route::get('/usuario', [InicioController::class, "user"]);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
  Route::resource("adotante", AdotanteController::class);
  Route::resource("animal", AnimalController::class);
});

// Route::post('/upload', function (Request $request) {
//   dd($request->file('arquivo')->store('', 'google'));
// });

// Route::get('/files', function () {
//   $files = Storage::disk('google')->files();
//   $url = Storage::disk('google')->url($files[0]);
//   echo ($url);
// });
