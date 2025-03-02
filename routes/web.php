<?php

use App\Http\Controllers\SocieteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/admin", function (){
    return view("admin.admin-home");
});

Route::get("admin/societes", [SocieteController::class, "index"])->name("societes");
Route::get("admin/create-societe", [SocieteController::class, "create"]);
Route::get("admin/societe-edit/{id}", [SocieteController::class, "edit"])->name("societes.edit");
Route::put("admin/societe-update/{id}", [SocieteController::class, "update"])->name('societes.update');
Route::post("admin/store-societe", [SocieteController::class, "store"])->name("societes.store");
Route::delete('admin/delete-societe/{id}', [SocieteController::class, "destroy"])->name('societes.destroy');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
