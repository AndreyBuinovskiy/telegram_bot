<?php

namespace App\Repositories;

use App\Models\Client;

class ClientsRepository extends AbstractRepository
{
    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * @param string $username
     * @param string $firstName
     * @param string $lastName
     * @param int $clientId
     * @param int $chatId
     * @return Client|\Eloquent|\Illuminate\Database\Eloquent\Model
     */
    public function store(string $phone, string $email): Client
    {
        $values = [
            'email' => $email,
            'phone_number' => $phone,
            'external_id' => (string)\Str::uuid()
        ];

        return $this->entity->firstOrCreate(['email' => $email], $values);
    }

    public function updateClientDataFromTelegram(
        string $externalId,
        string $chatId,
        string $clientsId,
        string $firstName,
        string $lastName,
        string $userName,
        string $imagePath
    ): Client
    {

        $values = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $userName,
            'clients_id' => $clientsId,
            'chat_id' => $chatId,
            'image_path' => $imagePath,
        ];

        return $this->entity->updateOrCreate(['external_id' => $externalId], $values);
    }

    public function getClient(string $externalId): Client
    {
        return $this->entity->firstWhere(['external_id' => $externalId]);
    }
}
