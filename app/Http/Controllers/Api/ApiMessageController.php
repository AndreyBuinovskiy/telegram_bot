<?php

namespace App\Http\Controllers\Api;


use App\Repositories\ClientsRepository;
use App\Repositories\MessageRepository;
use App\Services\Telegram\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiMessageController
{
    private MessageRepository $messageStore;
    private ClientsRepository $client;
    private TelegramService $service;

    public function __construct(MessageRepository $messageStore, ClientsRepository $client, TelegramService $service)
    {
        $this->messageStore = $messageStore;
        $this->client = $client;
        $this->service = $service;
    }

    public function send(Request $request){

        $message = $this->messageStore->store(
            $request->clientExternalId,
            $request->managerName,
            $request->message
        );

        $client = $this->client->getClient($message->client);

        if (empty($client)) {
            return ['success'=> false];
        }

        $paramsMessage = [
            'chat_id' => $client->chat_id,
            'text' => $message->message,
        ];

        $messageSend = $this->service->sendMessage($paramsMessage);

        return $messageSend;
    }

}
