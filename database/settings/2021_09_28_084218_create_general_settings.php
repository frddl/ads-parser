<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.is_active', true);
        $this->migrator->add('general.language', 'en');
        $this->migrator->add('general.telegram_id', '');
    }
}
