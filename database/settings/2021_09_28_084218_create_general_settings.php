<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.is_active', true);
        $this->migrator->add('general.language', 'en');
        $this->migrator->add('general.telegram_user_id', '');
        $this->migrator->add('general.telegram_bot_username', '');
        $this->migrator->add('general.telegram_bot_token', '');
        $this->migrator->add('general.telegram_notifications_enabled', false);
        $this->migrator->add('general.email_notifications_enabled', false);
        $this->migrator->add('general.email', '');
    }
}
