<?php

namespace App\Http\Controllers;

use App\Models\AdItem;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdItemController extends Controller
{
    public function create(): View
    {
        $providers = config('parsers.sites');
        return view('ad-item.create', compact('providers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->except('_token');
        AdItem::create($data);

        return redirect()->route('dashboard')->with('message', __('Successfully created!'));
    }

    public function edit(AdItem $adItem): View
    {
        $providers = config('parsers.sites');
        return view('ad-item.edit', compact('adItem', 'providers'));
    }

    public function update(Request $request, AdItem $adItem): RedirectResponse
    {
        $adItem->update($request->all());
        $adItem->save();

        return redirect()->back()->with('message', __('Item was updated!'));
    }

    public function destroy(AdItem $adItem): RedirectResponse
    {
        $adItem->delete();
        return redirect()->back()->with('message', __('Successfully deleted!'));
    }
}
