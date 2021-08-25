<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin.')->group(function () {
    Route::get('/', '\App\Http\Controllers\Backend\DashboardController@index')->name('index');

    Route::get('/setting', '\App\Http\Controllers\Backend\SettingController@index')->name('setting.index');
    Route::post('/setting/store', '\App\Http\Controllers\Backend\SettingController@store')->name('setting.store');
    Route::post('/setting/setwebhook', '\App\Http\Controllers\Backend\SettingController@setWebHook')->name('setting.setwebhook');
    Route::post('/setting/getwebhookinfo', '\App\Http\Controllers\Backend\SettingController@getWebHookInfo')->name('setting.getwebhookinfo');
});

Route::get('get-me', '\App\Http\Controllers\TelegramController@getMe');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::match((['post', 'get']), 'register', function () {
    Auth::logout();
    return redirect('/');
})->name('register');

require __DIR__ . '/auth.php';
