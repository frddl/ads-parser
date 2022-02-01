<?php

namespace App\Observers;

use App\Models\Result;
use App\Models\ResultProperty;
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
    public function created(ResultProperty $resultProperty)
    {
        $settings = app(GeneralSettings::class);
        if ($settings->telegram_notifications_enabled) {
            Notification::route('telegram', $settings->telegram_user_id)->notify(new ResultCreated($resultProperty->result));
        }

        if ($settings->email_notifications_enabled) {
            Notification::route('email', $settings->email)->notify(new ResultCreated($resultProperty->result));
        }
    }

    /**
     * Handle the Result "updated" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function updated(ResultProperty $resultProperty)
    {
        //
    }

    /**
     * Handle the Result "deleted" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function deleted(ResultProperty $resultProperty)
    {
        //
    }

    /**
     * Handle the Result "restored" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function restored(ResultProperty $resultProperty)
    {
        //
    }

    /**
     * Handle the Result "force deleted" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function forceDeleted(ResultProperty $resultProperty)
    {
        //
    }
}
