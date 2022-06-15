<?php

namespace App\Http\Controllers;

use App\Models\AdItem;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $ad_items = AdItem::withCount('results')->paginate(20);
        return view('dashboard', compact('ad_items'));
    }

    public function settings(GeneralSettings $settings): View
    {
        $debug = config('app.debug');
        return view('settings', compact('settings', 'debug'));
    }

    public function settingsStore(Request $request, GeneralSettings $settings): RedirectResponse
    {
        $settings->is_active = $request->input('is_active');
        $settings->language = $request->input('language');
        $settings->telegram_user_id = $request->input('telegram_user_id', '');
        $settings->telegram_bot_username = $request->input('telegram_bot_username', '');
        $settings->telegram_bot_token = $request->input('telegram_bot_token', '');
        $settings->email = $request->input('email', '');

        $settings->telegram_notifications_enabled = $request->has('telegram_notifications_enabled');
        $settings->email_notifications_enabled = $request->has('email_notifications_enabled');
        $settings->proxy_enabled = $request->has('proxy_enabled');

        $settings->save();

        return redirect()->back()->with('message', __('Settings updated!'));
    }
}
