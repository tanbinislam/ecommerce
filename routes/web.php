<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
Route::get('/shop', [AdminController::class, 'adminDashboard'])->name('shop');
Route::get('/shop/users', [AdminController::class, 'users'])->name('allUsers');
Route::get('/shop/user/add', [AdminController::class, 'addUser'])->name('addUser');
Route::post('/shop/user/create', [AdminController::class, 'createUser'])->name('createUser');
Route::get('/shop/user/edit/{user}', [AdminController::class, 'editUser'])->name('editUser');
Route::post('/shop/user/update/{user}', [AdminController::class, 'updateUser'])->name('updateUser');
Route::get('/shop/user/view/{user}', [AdminController::class, 'viewUser'])->name('viewUser');
Route::get('/shop/user/trash', [AdminController::class, 'viewSoftDeletedUsers'])->name('trashedUsers');
Route::post('/shop/user/delete/{user}', [AdminController::class, 'softDeleteUser'])->name('deleteUser');
Route::post('/shop/user/restore/{id}', [AdminController::class, 'restoreUser'])->name('restoreUser');
Route::post('/shop/user/permanent-delete/{id}', [AdminController::class, 'permanentDeleteUser'])->name('permanentDeleteUser');