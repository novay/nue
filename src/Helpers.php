<?php

if(!function_exists('me')) {
    /**
     * Get user based on whom login.
     *
     * @return string
     */
    function me() 
    {
        return auth()->check() ? auth()->user() : null;
    }
}

if (!function_exists('notify')) {
    /**
     * Return app instance of Notify.
     * 
     * @return Novay\Notify\Notifier
     */
    function notify() {
        return app('notify');
    }
}

if (!function_exists('time_execute')) {
    /**
     * Return time execute.
     * 
     * @param string $time
     * @return string
     */
    function time_execute($time = '') {
        $micro = microtime(TRUE);
        return number_format($micro - $time, 2);
    }
}