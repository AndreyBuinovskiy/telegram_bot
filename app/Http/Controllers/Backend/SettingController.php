<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        return view('backend.setting', Setting::getSettings());
    }

    public function store(Request $request)
    {
        Setting::where('key', '!=', NULL)->delete();

        foreach ($request->except('_token', 'currency') as $key => $value) {
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $request->$key;
            $setting->save();
        }

        return redirect()->route('admin.setting.index');
    }

    public function setWebHook(Request $request)
    {
        $result = $this->sendTelegramData('setwebhook', [
            'query' => ['url' => $request->url . '/' . env('TELEGRAM_BOT_TOKEN')]
        ]);

        return redirect()->route('admin.setting.index')->with('status', $result);
    }

    public function getWebHookInfo(Request $request){
        $result = $this->sendTelegramData('getWebhookInfo');

        return redirect()->route('admin.setting.index')->with('status', $result);
    }

    public function sendTelegramData($route = '', $params = [], $method = 'POST')
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/']);
        $result = $client->request($method, $route, $params);
        return (string) $result->getBody();
    }
}
