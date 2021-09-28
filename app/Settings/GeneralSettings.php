<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $is_active;
    public string $language;
    public string $telegram_id;

    public static function group(): string
    {
        return 'general';
    }
}
