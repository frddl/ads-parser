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
        $ad_items = AdItem::paginate(20);
        return view('dashboard', compact('ad_items'));
    }

    public function settings(GeneralSettings $settings): View
    {
        return view('settings', [
            'is_active' => $settings->is_active,
            'language' => $settings->language,
            'telegram_id' => $settings->telegram_id
        ]);
    }

    public function settingsStore(Request $request, GeneralSettings $settings): RedirectResponse
    {
        $settings->is_active = $request->input('is_active');
        $settings->language = $request->input('language');
        $settings->telegram_id = $request->input('telegram_id');

        $settings->save();

        return redirect()->back();
    }
}
