<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ClientsRepository;
use App\Repositories\MessageRepository;
use App\Services\Telegram\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiMessageController
{
    private SendMessageService $sendMessageService;    

    public function __construct(SendMessageService $sendMessageService)
    {
        $this->sendMessageService = $sendMessageService;
    }

    public function send(Request $request): array
    {
        try {
            return $this->sendMessageService->send($request->clientExternalId, $request->managerName, $request->message);
        } catch (\Exception $exception) {
            return [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
    }
}
