<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Repositories\ClientsRepository;
use App\Services\Telegram\TelegramService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        \Log::emergency(json_decode($message, true));
        \Log::emergency($message->text);


        if (strpos($message->text, '/start ') !== false) {
            $messageText = explode(" ", $message->text)[0];
            $externalId = explode(" ", $message->text)[1];

            $telegramPhoto = $this->service->getUserProfilePhotos([
                'user_id' => $message->from->id,
                'offset' => 1,
                'limit' => 1
            ]);

            $photo = $this->service->getFile([
                'file_id' => $telegramPhoto->photos[0][0]['file_id'],
            ]);

            if (Storage::missing($externalId . '.jpg')) {
                Storage::put('public/clients/image/' . $externalId . '.jpg', file_get_contents("https://api.telegram.org/file/bot" . env('TELEGRAM_BOT_TOKEN') . "/" . $photo->filePath));
                $url = Storage::url($externalId . '.jpg');
            }

            \Log::emergency($url);
            $return = $client->updateClientDataFromTelegram(
                $externalId,
                $message->chat->id ?? "",
                $message->from->id ?? "",
                $message->from->firstName ?? "",
                $message->from->lastName ?? "",
                $message->from->username ?? "",
                $externalId . '.jpg' ?? "",
            );

            $urlInApp = 'https://provodnik.kalinski-centr.online/version-test/?id=' . $externalId;
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
