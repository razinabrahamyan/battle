<?php

namespace App\Http\Controllers\Localization;

use App\Http\Controllers\Controller;
use App\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function __invoke($locale,$type = null)
    {
        $languages = config('app.languages');
        if (in_array($locale, $languages)){
            Session::put('locale', $locale);
            App::setLocale($locale);
            if($type === 'user' && auth()->check()){
                $id = Locales::where('short',$locale)->first()->id;
                auth()->user()->lang_id = $id;
                auth()->user()->save();
            }
        } else {
            Session::put('locale', config('app.fallback_locale'));
            App::setLocale(config('app.fallback_locale'));
            abort(404);
        }
        return redirect(url()->previous());
    }
}
