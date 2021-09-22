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
    return view('register_clients');
});

Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('index');
    //форма для постановки вебхука в телеграм
    Route::get('/setting', [\App\Http\Controllers\Backend\SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/store', [\App\Http\Controllers\Backend\SettingController::class, 'store'])->name('setting.store');
    Route::post('/setting/setwebhook', [\App\Http\Controllers\Backend\SettingController::class, 'setWebHook'])->name('setting.setwebhook');
    Route::post('/setting/getwebhookinfo', [\App\Http\Controllers\Backend\SettingController::class, 'getWebHookInfo'])->name('setting.getwebhookinfo');
});

//апи для получения данных о клиенте(НАУЧИТСЯ ДЕЛАТЬ ЧЕРЕЗ АПИ ЛАРАВЕЛЯ И ПЕРЕДЕЛАТЬ)
Route::prefix('clients')->group(function () {
    Route::get('/{clients_id}', [\App\Http\Controllers\Api\ApiClientsController::class, 'get']);
});

//Отправка сообщения с бабл в телеграм
Route::prefix('/message')->group(function () {
    Route::get('/send-message', [\App\Http\Controllers\Api\ApiMessageController::class, 'send']);
});

//обработка формы на главной странице
Route::post('/create-clients', [\App\Http\Controllers\Backend\ClientFormController::class, 'createClients'])->name('setting.createClients');

//обработка вебхука с телеграма
Route::post('/webhooks/telegram/' . env('TELEGRAM_BOT_TOKEN'), [\App\Http\Controllers\Webhooks\TelegramController::class, 'proces']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::match((['post', 'get']), 'register', function () {
    Auth::logout();
    return redirect('/');
})->name('register');

require __DIR__ . '/auth.php';
