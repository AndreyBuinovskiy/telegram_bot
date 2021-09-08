<?php

namespace app\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ClientsRepository;
use Illuminate\Http\Request;

class ClientFormController extends Controller
{
    public function createClients(Request $request, ClientsRepository $client)
    {
        //Сохраняем клиента
        $return = $client->store(
            (string)$request->input('phone') ?? '',
            $request->input('email') ?? ''
        );

        return redirect()->away("https://t.me/DmitriiKalinskiiBot?start=".$return->getAttributes()['external-id']);
    }
}
