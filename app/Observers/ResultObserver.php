<?php

namespace App\Observers;

use App\Models\Result;
use App\Notifications\ResultCreated;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Notification;

class ResultObserver
{
    /**
     * Handle the Result "created" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function created(Result $result)
    {
        $settings = app(GeneralSettings::class);
        if ($settings->telegram_notifications_enabled) {
            Notification::route('telegram', $settings->telegram_user_id)->notify(new ResultCreated($result));
        }

        if ($settings->email_notifications_enabled) {
            Notification::route('email', $settings->email)->notify(new ResultCreated($result));
        }
    }

    /**
     * Handle the Result "updated" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function updated(Result $result)
    {
        //
    }

    /**
     * Handle the Result "deleted" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function deleted(Result $result)
    {
        //
    }

    /**
     * Handle the Result "restored" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function restored(Result $result)
    {
        //
    }

    /**
     * Handle the Result "force deleted" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function forceDeleted(Result $result)
    {
        //
    }
}
