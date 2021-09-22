<?php

namespace App\Http\Controllers\Api;


use App\Repositories\ClientsRepository;
use App\Repositories\MessageRepository;
use App\Services\Telegram\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiMessageController
{
    public function send(Request $request, MessageRepository $messageStore, ClientsRepository $client){
        $message = $messageStore->store(
            $request->clientExternalId,
            $request->menedgerName,
            $request->message
        );

        $client = $client->getClient($message->client);

        if (!empty($client)) {
            return ['success'=> false];
        }

        $paramsMessage = [
            'chat_id' => $client->getClient($message->client)->chat_id,
            'text' => $message->message,
        ];

        $messageSend = $this->sendMessage($paramsMessage);

        return $messageSend;
    }

    private function sendMessage(array $paramsMessage, TelegramService $service){

        return $service->sendMessage($paramsMessage);

    }


}
