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
    public $email;

    public static function group(): string
    {
        return 'general';
    }
}
