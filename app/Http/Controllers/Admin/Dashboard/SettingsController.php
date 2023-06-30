<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\ExtraModels\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setEntries(Request $request)
    {
        Session::put('battles-entries', $request->entries);
        return response()->json('success', 200);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function battleView()
    {
        $settings = Settings::where('title', 'battle')->firstOrFail();
        return view('dashboard.settings.battle.index', ['settings' => $settings]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function battleUpdate(Request $request)
    {
         $request->validate([
             'rounds_max' => 'numeric|min:1|max:100',
             'rounds_min' => 'numeric|min:1|max:100|lt:rounds_max',
        ]);

        $settings = Settings::where('title', 'battle')->firstOrFail();
        $settings->update([
            'attributes' => ['rounds_min' => $request->rounds_min, 'rounds_max' => $request->rounds_max]
        ]);

        return redirect()->back()->with(['success' => 'The settings saved']);
    }
}
