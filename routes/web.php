<?php

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
    return Inertia::render('LoginPage');
});
Route::get('/dash', function (){
    return Inertia::render('Dashboard',[
        'name' => 'Yusuf',
        'userProfile' => [
            'Ивази рамз', 'Баромад'
        ]
    ]);
});
Route::get('/input', function (){
    return Inertia::render('InputForm');
});
Route::get('/inputb', function (){
    return Inertia::render('InputFormBisyor');
});
Route::get('/test', function (){
    return Inertia::render('TestCom');
});
