<?php

namespace App\Traits;

use App\Models\SiteSetting;
use Serv5group\Whatscloudapi\WebCloud;

trait HasSendMessage
{
    public function sendMessage($phone, $message): bool
    {
        $settings = SiteSetting::first();
        $token = $settings->whatsapp_token;
        $instance = $settings->whatsapp_instance;
        $response = WebCloud::accessToken($token)
            ->setInstance($instance)
            ->to($phone)
            ->message($message)
            ->send();

        if ($response != null &&
            $response->status == 'success' &&
            isset($response->message) &&
            $response->message !== 'The number of messages you have sent per month has exceeded the maximum limit') {
            return true;
        } else {
            //\Log::error($response);
            return false;
        }
    }
}
