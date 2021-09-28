<?php

namespace App\Http\Controllers;

use App\Models\AdItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $ad_items = AdItem::paginate(20);
        return view('dashboard', compact('ad_items'));
    }
}
