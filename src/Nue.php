<?php

namespace Novay\Nue;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class Nue.
 */
class Nue
{
    /**
     * The Nue version.
     *
     * @var string
     */
    const VERSION = '1.00';

    /**
     * @var array
     */
    public static $extensions = [];

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
}