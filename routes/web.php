<?php

use App\Http\Controllers\Bisyorjoniba\BisyorjonibaConroller;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dujoniba\DujonibaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShartnomaListController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Visitor\VisitorController;
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
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.auth');
Route::post('logoute', [LoginController::class, 'logoute'])->name('logoute');

Route::middleware('auth')->group(function(){

           //All Routes which needs user to be logged in
    Route::group(['middleware' => 'is_admin'], function(){
        // ===================Dujoniba CRUD==================
        Route::controller(DujonibaController::class)->group(function(){
            Route::get('/duinput','create')->name('duinput.create');
            Route::post('/dostore', 'store')->name('du.store');
            Route::get('/doindex', 'index')->name('do.index');
            Route::get('/ducard/{id}', 'show')->name('do.card');
            Route::put('/dujoniba/{item}','update')->name('du.update');
            Route::get('/dujoniba/{item}/edit', 'edit')->name('du.edit');
            Route::delete('/delete/{item}', 'destroy')->name('du.delete');
            Route::get('/dujoniba/file/{id}', 'downloadD')->name('du.download');
            Route::post('/card/{id}', 'qatiDasti')->name('du.qatdast');
            // =============Delete files of part six inputs========================
            Route::delete('/fileqaror/{id}', 'deleteqaror')->name('del.qaror');
            // ==================Delete files of vakolat inputs=====================
            Route::delete('/filevakolat/{id}', 'deletevakolat')->name('del.vakolat');
            // ==================Delete files of shartnoma =====================
            Route::delete('/shartnoma/{id}', 'deleteShartnoma')->name('del.shartnoma');
            Route::get('/searchn','seracN')->name('do.serch');
            // =============Delete ezoh in edit form=========================
            Route::delete('/dujonibash/{id}/ezoh/{ezoh}', 'deleteEzohD')->name('delD.ezoh');
        });

        // =====================Dashboard items========================
        Route::controller(DashboardController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('dash.index');
        });

        // Bisyorjoniba CRUD
        Route::controller(BisyorjonibaConroller::class)->group(function (){
            Route::get('/indexb', 'index')->name('bi.index');
            Route::get('/createb', 'create')->name('bi.create');
            Route::post('/storeb', 'store')->name('bi.store');
            Route::get('/cardb/{id}', 'show')->name('bi.card');
            Route::get('/editb/{id}', 'edit')->name('bi.edit');
            Route::post('/cardbq/{id}', 'qatiDastiB')->name('bi.qatidast');
            Route::put('/updateb/{id}', 'update')->name('bi.update');
            Route::delete('/deleteb/{id}', 'destroy')->name('bi.delete');
            Route::get('/downloadb/file/{id}', 'downloadB')->name('bi.download');
            // =============Delete mintaqa in edit form=========================
            Route::delete('/mintaqa/{id}/country/{country}', 'deleteMintaqa')->name('del.mintaqa');
            // =============Delete ezoh in edit form=========================
            Route::delete('/shartnoma/{id}/ezoh/{ezoh}', 'deleteEzoh')->name('del.ezoh');
            // ================= File shartnoma delete on update======================
            Route::delete('/delfile/{id}', 'deleteFiles')->name('del.files');
            // =================  Delete shartnoma file on update======================
            Route::delete('/delshartnoma/{id}', 'fileDelete')->name('del.shartnomaB');
        });

        // Shartnoma files and Ijronashuda list for downloading
        Route::controller(ShartnomaListController::class)->group(function(){
            Route::get('/files', 'index')->name('files.index');
            Route::get('/files/{id}', 'downloadOne')->name('file.download');
            Route::post('/files/download', 'selectDownload')->name('file.zip');
            // ==================Ijronashuda section========================

            Route::get('/ijronashuda', 'shIjronashuda')->name('sh.ijronashuda');
        });

        //     User section for adding, editing and deleting
        Route::controller(UserController::class)->group(function(){
            Route::get('/users', 'index')->name('users.index');
            Route::get('/user/add', 'create')->name('user.create');
            Route::post('/user/store', 'store')->name('user.store');
            Route::get('/user/{id}/edit', 'edit')->name('user.edit');
            Route::put('/user/{id}','update')->name('user.update');
            Route::delete('/user/delete/{id}','destroy')->name('user.delete');
        });
    });


    // For user who have permision only read and search
    Route::controller(VisitorController::class)->group(function(){
        Route::get('/guest','index')->name('guest.index');
        Route::get('/visitors/cardD/{id}', 'showD')->name('vid.card');
        Route::get('/guest/bisyorjoniba', 'bindex')->name('bg.index');
        Route::get('/visitors/cardB/{id}', 'showB')->name('vib.card');
    });



});





