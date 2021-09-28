<?php

namespace App\Http\Controllers;

use App\Models\AdItem;
use App\Models\Result;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(): View
    {
        $results = Result::paginate(20);
        return view('results', compact('results'));
    }

    public function view(AdItem $adItem, Result $result): View
    {
        return view('ad-item.result', compact('adItem', 'result'));
    }

    public function link(AdItem $adItem, Result $result): RedirectResponse
    {
        $providerClass = config('parsers.strategy.' . $adItem->provider);
        $provider = new $providerClass($result);
        return redirect()->away($provider->generateAdUrl());
    }

    public function destroy(AdItem $adItem, Result $result): RedirectResponse
    {
        $result->delete();
        return redirect()->back()->with('message', __('Successfully deleted!'));
    }
}
