<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $is_active;
    public string $language;
    public string $telegram_user_id;
    public string $telegram_bot_username;
    public string $telegram_bot_token;
    public string $email;

    public static function group(): string
    {
        return 'general';
    }
}
