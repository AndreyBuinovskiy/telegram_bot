<?php

namespace App\Services\Message;

use App\Repositories\ClientsRepository;
use App\Repositories\MessageRepository;
use App\Services\Telegram\TelegramService;
use RuntimeException;

class SendMessageService
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

    /**
     * Returns array describing message
     *
     * @param string $clientExternalUid
     * @param string $managerName
     * @param string $message
     * @return array
     */
    public function send(string $clientExternalUid, string $managerName, string $message): array
    {
        $message = $this->messageStore->store($clientExternalUid, $managerName, $message);

        $client = $this->client->getClient($message->client);

        if (empty($client)) {
            throw new RuntimeException(__('send_message_service.client_not_found'));
        }

        $messageData = $this->service->sendMessage([
            'chat_id' => $client->chat_id,
            'text' => $message->message,
        ]);

        return $messageData;
    }
}
