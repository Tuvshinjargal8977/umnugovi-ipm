<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /** Дэмжигдэх хэлүүд */
    public const SUPPORTED = ['mn', 'en'];

    public function handle(Request $request, Closure $next)
    {
        // ?lang=en эсвэл сешн дэх сонголт
        $locale = $request->query('lang')
            ?? Session::get('locale')
            ?? config('app.locale');

        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
