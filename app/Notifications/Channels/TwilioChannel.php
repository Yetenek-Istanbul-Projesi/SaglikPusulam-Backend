<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class TwilioChannel
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.account_sid'),
            config('services.twilio.auth_token')
        );
    }

    public function send($notifiable, Notification $notification)
    {
        try {
            if (!method_exists($notification, 'toTwilio')) {
                throw new \Exception('Notification does not have toTwilio method');
            }

            $message = $notification->toTwilio($notifiable);

            if (empty($message['content'])) {
                throw new \Exception('Message content is empty');
            }

            $to = $notifiable->routeNotificationFor('sms');

            if (empty($to)) {
                throw new \Exception('No phone number provided for notification');
            }

            // Log the attempt
            \Log::info("Sending SMS:", [
                'to' => $to,
                'from' => config('services.twilio.phone_number'),
                'message' => $message['content']
            ]);

            // Send the actual SMS
            $this->client->messages->create(
                $to,
                [
                    'from' => config('services.twilio.phone_number'),
                    'body' => $message['content']
                ]
            );
            
        } catch (\Exception $e) {
            \Log::error("Twilio SMS error: " . $e->getMessage());
            throw $e;
        }
    }
}
