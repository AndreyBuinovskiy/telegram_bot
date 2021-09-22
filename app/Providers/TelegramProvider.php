<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Telegram\Bot\Api;

class TelegramProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Api::class, static function ($app) {
            return new Api(env('TELEGRAM_BOT_TOKEN'));
        });

        $this->app->bind(TelegramService::class, static function ($app) {
            $api = $app->get(Api::class);

            return new TelegramService($api);
        });
    }
}
