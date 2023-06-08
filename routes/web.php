<?php

use App\Http\Controllers\Dujoniba\DujonibaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [LoginController::class, 'showLogin'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login.auth');
Route::post('logoute', [LoginController::class, 'logoute'])->name('logoute');
Route::get('/dash', function (){
    return Inertia::render('Dashboard',[
        'name' => 'Yusuf',
        'userProfile' => [
            'Ивази рамз', 'Баромад'
        ]
    ]);
})->name('index');
Route::get('/duinput',[DujonibaController::class,'create'])->name('duinput.create');
Route::post('/dostore', [DujonibaController::class, 'store'])->name('du.store');
Route::get('/doindex',[DujonibaController::class, 'index'])->name('do.index');
Route::put('/dujoniba/{item}',[DujonibaController::class, 'update'])->name('du.update');
Route::get('/dujoniba/{item}/edit', [DujonibaController::class, 'edit'])->name('du.edit');
Route::delete('/delete/{item}',[DujonibaController::class, 'destroy'])->name('du.delete');


    // For user who have permision only read and search
Route::get('/guest',[DujonibaController::class, 'guestIndex'])->name('guest.index');

Route::get('/inputb', function (){
    return Inertia::render('Bisyorjoniba/Add');
});
Route::get('/test', function (){
    return Inertia::render('Dujoniba/Test');
});

//     User section for adding, editing and deleting
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/add', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
