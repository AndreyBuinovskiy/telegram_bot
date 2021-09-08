<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Repositories\ClientsRepository;
use App\Services\Telegram\TelegramService;
use Hashids\Hashids;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramController extends Controller
{
    private TelegramService $service;

    public function __construct(TelegramService $service)
    {
        $this->service = $service;
    }

    public function proces(ClientsRepository $client)
    {
        $result = $this->service->getWebhookUpdate();
        $message = $result->getMessage();
        $messageText = explode(" ", $message->text)[0];
        $externalId = explode(" ", $message->text)[1];

        $return = $client->updateClientDataFromTelegram(
            $externalId,
            $message->chat->id ?? "",
            $message->from->id ?? "",
            $message->from->firstName ?? "",
            $message->from->lastName ?? "",
            $message->from->username ?? "",
        );

        Log::emergency(json_decode($return->external_id, true));

        if (hash_equals($messageText, '/start')) {
            $urlInApp = 'https://provodnik.kalinski-centr.online/?id=';
            $keyboard = Keyboard::make()
                ->inline()
                ->row(
                    Keyboard::inlineButton(['text' => 'Начать курс', 'url' => $urlInApp]),
                )
                ->setResizeKeyboard(true)
                ->setOneTimeKeyboard(true);
            $params = [
                'chat_id' => $message->chat->id,
                'text' => '
                Добро пожаловать в нашего бота!
                Данный бот будет рассылать вам оповещения.
                А сейчас вы должны перейти на
                наше приложени для начала обучения',
                'reply_markup' => $keyboard,
            ];
            $this->service->sendMessage($params);
        }
    }


}
