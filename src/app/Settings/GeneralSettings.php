<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $is_active;
    public string $language;

    public $telegram_user_id;
    public $telegram_bot_username;
    public $telegram_bot_token;
    public bool $telegram_notifications_enabled;

    public $email;
    public bool $email_notifications_enabled;

    public bool $proxy_enabled;

    public static function group(): string
    {
        return 'general';
    }
}
