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
        return view('ad-item.create');
    }

    public function edit(AdItem $adItem): View
    {
        return view('ad-item.edit', compact('adItem'));
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
