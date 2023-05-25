<?php

use App\Http\Controllers\Dujoniba\DujonibaController;
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

Route::get('/', function () {
    //sleep(2);
    return Inertia::render('Welcome');
});
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

    // For user who have permision only read and search
Route::get('/guest',[DujonibaController::class, 'guestIndex'])->name('guest.index');

Route::get('/inputb', function (){
    return Inertia::render('Bisyorjoniba/Add');
});
Route::get('/test', function (){
    return Inertia::render('Dujoniba/Test');
});
