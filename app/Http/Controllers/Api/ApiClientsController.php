<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ClientsRepository;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class ApiClientsController
{
    public function get($clients_id, ClientsRepository $client)
    {
        $clients = $client->getClient($clients_id);

        if (Storage::exists('images/clients/image/'.$clients->external_id . '.jpg')) {
            //$url = env('APP_URL').'images/clients/image/'.$clients->external_id . '.jpg';
            $url ='https://c2f0-176-96-225-253.ngrok.io/images/clients/image/'.$clients->external_id . '.jpg';
        }

        return [
            'external_id' => $clients->external_id,
            'username' => $clients->username,
            'first_name' => $clients->first_name,
            'last_name' => $clients->last_name,
            'chat_id' => $clients->chat_id,
            'phone_number' => $clients->phone_number,
            'email' => $clients->email,
            'image' => $url,
        ];
    }
}
