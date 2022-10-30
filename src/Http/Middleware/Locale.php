<?php

namespace Novay\Nue\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $languages = config('nue.locales');
            
            if(Cookie::has('locale')) {
                // Get the current language
                $language = Cookie::get('locale');

                if(array_key_exists($language, $languages)) {
                    App::setLocale($language);
                } else {
                    App::setLocale(config('app.locale'));
                }
            }
            // Attempt to read the user's language preference
            elseif($request->server('HTTP_ACCEPT_LANGUAGE')) {
                $language = explode('-', $request->server('HTTP_ACCEPT_LANGUAGE'));

                if(array_key_exists($language[0], $languages)) {
                    App::setLocale($language[0]);
                } else {
                    App::setLocale(config('app.locale'));
                }
            }
            // Set the language to the default one
            else {
                App::setLocale(config('app.locale'));
            }
        } catch (\Exception $e) {
        }

        return $next($request);
    }
}