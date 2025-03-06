<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

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

Route::get('/',[UserManagementController::class, 'index'])->name('users.index');
Route::get('/create',[UserManagementController::class, 'create'])->name('users.create');
Route::post('/store', [ UserManagementController::class,'store'])->name('users.store');
Route::get('/edit/{id}', [ UserManagementController::class,'edit'])->name('users.edit');
Route::post('/update', [ UserManagementController::class,'update'])->name('users.update');
Route::get('/delete/{id}', [ UserManagementController::class,'delete'])->name('users.delete');
Route::get('sample-data', function () {
    Artisan::call('db:seed');
    return redirect()->route('users.index')->with('message',"User successfully registered");
})->name('smaple-data');
