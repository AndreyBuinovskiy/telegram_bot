<?php

namespace App\Services\Telegram;

use phpDocumentor\Reflection\Types\This;
use Telegram\Bot\Api;
use App\Contracts\BotInterface;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram;

class TelegramService implements BotInterface
{
    private Api $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function getWebhookInfo()
    {
        return $this->api->getWebhookInfo();
    }

    public function getWebhookUpdate()
    {
        return $this->api->getWebhookUpdate();
    }

    public function sendMessage($params)
    {
//        $keyboard = Keyboard::make()
//            ->inline()
//            ->row(
//                Keyboard::inlineButton(['text' => 'Test', 'callback_data' => 'data']),
//                Keyboard::inlineButton(['text' => 'Btn 2', 'callback_data' => 'data_from_btn2'])
//            );
//        $params = [
//            'chat_id'=>822840049,
//            'text' => 'Ели пали',
//            'reply_markup' => $keyboard
//        ];
       return $this->api->sendMessage($params);
    }

    public function getUserProfilePhotos(array $params)
    {
        return $this->api->getUserProfilePhotos($params);
    }

    public function getFile(array $params)
    {
        return $this->api->getFile($params);
    }
}
