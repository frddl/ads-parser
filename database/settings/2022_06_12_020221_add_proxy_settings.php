<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddProxySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.proxy_enabled', false);
    }
}
