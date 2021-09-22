<?php

namespace App\Contracts;

interface BotInterface
{
    /**
     * @return mixed
     */
    public function getWebHookInfo();

    /**
     * @return mixed
     */
    public function getWebhookUpdate();

    public function sendMessage($params);

    public function getUserProfilePhotos(array $params);
}
