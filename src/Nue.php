<?php

namespace Novay\Nue;

use Closure;
use Illuminate\Support\Facades\Auth;
use Novay\Nue\Traits\HasMenu;
use Novay\Nue\Traits\HasAssets;

use Novay\Nue\Traits\Assets\Js;
use Novay\Nue\Traits\Assets\Css;
use Novay\Nue\Traits\Assets\Html;

use Novay\Nue\Layout\Content;

class Nue
{
    use HasMenu;
    use Js, Css, Html;

    /**
     * The Nue version.
     *
     * @var string
     */
    const VERSION = '3.00';

    /**
     * @var array
     */
    public static $extensions = [];

    /**
     * @var []Closure
     */
    protected static $bootingCallbacks = [];

    /**
     * @var []Closure
     */
    protected static $bootedCallbacks = [];

    /**
     * Returns the long version of Nue.
     *
     * @return string The long application version
     */
    public static function getLongVersion()
    {
        return sprintf('Nue <comment>version</comment> <info>%s</info>', self::VERSION);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->guard()->user();
    }

    /**
     * Attempt to get the guard from the local cache.
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard()
    {
        $guard = config('nue.guard') ?: 'web';

        return Auth::guard($guard);
    }

    /**
     * Extend a extension.
     *
     * @param string $name
     * @param string $class
     *
     * @return void
     */
    public static function extend($name, $class)
    {
        static::$extensions[$name] = $class;
    }

    /**
     * Register the nue builtin routes.
     *
     * @return void
     */
    public function registerAuthRoutes()
    {
        $this->routes();
    }

    /**
     * Register the nue builtin routes.
     *
     * @return void
     */
    public function routes()
    {
        // 
    }

    /*
     * Disable Pjax for current Request
     *
     * @return void
     */
    public function disablePjax()
    {
        if (request()->pjax()) {
            request()->headers->set('X-PJAX', false);
        }
    }

    /**
     * @param Closure $callable
     *
     * @return \Novay\Nue\Layout\Content
     */
    public function content(Closure $callable = null)
    {
        return new Content($callable);
    }

    /**
     * Starting the nue application.
     */
    public function start()
    {
        $this->fireBootingCallbacks();

        $this->fireBootedCallbacks();
    }

    /**
     * Call the booting callbacks for the admin application.
     */
    protected function fireBootingCallbacks()
    {
        foreach (static::$bootingCallbacks as $callable) {
            call_user_func($callable);
        }
    }

    /**
     * Call the booted callbacks for the admin application.
     */
    protected function fireBootedCallbacks()
    {
        foreach (static::$bootedCallbacks as $callable) {
            call_user_func($callable);
        }
    }
}