<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository extends AbstractRepository
{
    public function __construct(Message $message)
    {
        parent::__construct($message);
    }

    public function store(string $clientExtrernalId, string $manadger, string $message): Message
    {
        $values = [
            'client' => $clientExtrernalId,
            'manager' => $manadger,
            'message' => $message
        ];

        return $this->entity->create($values);
    }
}
