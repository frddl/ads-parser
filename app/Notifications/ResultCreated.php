<?php

namespace App\Notifications;

use App\Models\ResultProperty;
use App\Settings\GeneralSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;

class ResultCreated extends Notification implements ShouldQueue
{
    use Queueable;

    private $result;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toTelegram($notifiable)
    {
        $property = $this->result->property->data;
        Log::debug($property);

        $adItem = $this->result->adItem;
        $ad_url = config('parsers.sites.' . $adItem->provider)['url'] . $this->result->result_link;

        $settings = app(GeneralSettings::class);
        $content = __('New ad');

        if ($adItem->keyword) {
            $content .= " ($adItem->keyword):";
        }

        return TelegramFile::create()
            ->token($settings->telegram_bot_token)
            ->content($content . "\n*" . $property['notification_title'] . "*\n\n" . $property['notification_description'])
            ->photo($property['notification_image'])
            ->button(__('Ad link'), $ad_url)
            ->button(__('Open System'), config('app.url'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
