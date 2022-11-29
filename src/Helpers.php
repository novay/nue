<?php

use Illuminate\Support\MessageBag;
use Novay\Nue\Facades\Nue;
use Novay\Nue\Layout\Content;
use Novay\Nue\Exception\NueException;

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

if (!function_exists('nue_url')) {
    /**
     * Get nue url.
     *
     * @param string $path
     * @param mixed  $parameters
     * @param bool   $secure
     *
     * @return string
     */
    function nue_url($path = '', $parameters = [], $secure = null)
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: (config('nue.https') || config('nue.secure'));

        return url(nue_base_path($path), $parameters, $secure);
    }
}

if (!function_exists('nue_base_path')) {
    /**
     * Get nue url.
     *
     * @param string $path
     *
     * @return string
     */
    function nue_base_path($path = '')
    {
        $prefix = '/'.trim(config('nue.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix.'/'.$path;
    }
}

if (!function_exists('nue_path')) {
    /**
     * Get Nue path.
     *
     * @param string $path
     *
     * @return string
     */
    function nue_path($path = '')
    {
        return ucfirst(config('nue.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('nue_asset')) {
    /**
     * @param $path
     *
     * @return string
     */
    function nue_asset($path)
    {
        return config('nue.https') ? secure_asset($path) : asset($path);
    }
}

if (!function_exists('array_delete')) {
    /**
     * Delete from array by value.
     *
     * @param array $array
     * @param mixed $value
     */
    function array_delete(&$array, $value)
    {
        $value = \Illuminate\Support\Arr::wrap($value);

        foreach ($array as $index => $item) {
            if (in_array($item, $value)) {
                unset($array[$index]);
            }
        }
    }
}

if (!function_exists('human_file_size')) {
    /**
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function human_file_size($bytes, $precision = 2): string
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return number_format($bytes, $precision, ',', '.') . ' ' . $units[$pow];
    }
}

if (!function_exists('get_file_data')) {
    /**
     * @param string $file
     * @param bool $toArray
     * @return bool|mixed
     */
    function get_file_data($file, $toArray = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($toArray) {
                return json_decode($file, true);
            }

            return $file;
        }

        if (!$toArray) {
            return null;
        }

        return [];
    }
}

if (!function_exists('echo_limit')) {
    /**
     * @param string $file
     * @param bool $toArray
     * @return bool|mixed
     */
    function echo_limit($x, $length = 200)
    {
        if(strlen($x) <= $length):
            echo $x;
        else:
            return substr($x, 0, $length) . '...';
        endif;
    }
}

if (!function_exists('nue_notify')) {

    /**
     * Flash a notify message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     */
    function nue_notify($message = '', $type = 'success', $options = [])
    {
        $notify = new MessageBag(get_defined_vars());

        session()->flash('notify', $notify);
    }
}

if (!function_exists('nue_success')) {

    /**
     * Flash a success message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function nue_success($title, $message = '')
    {
        nue_info($title, $message, 'success');
    }
}

if (!function_exists('nue_error')) {

    /**
     * Flash a error message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function nue_error($title, $message = '')
    {
        nue_info($title, $message, 'error');
    }
}

if (!function_exists('nue_warning')) {

    /**
     * Flash a warning message bag to session.
     *
     * @param string $title
     * @param string $message
     */
    function nue_warning($title, $message = '')
    {
        nue_info($title, $message, 'warning');
    }
}

if (!function_exists('nue_info')) {

    /**
     * Flash a message bag to session.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     */
    function nue_info($title, $message = '', $type = 'info')
    {
        $message = new MessageBag(get_defined_vars());

        session()->flash($type, $message);
    }
}

if (!function_exists('nue_view')) {
    /**
     * Custom view for using Nue Content.
     *
     * @param  string|null  $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $data
     * @param  string|null  $title
     */
    function nue_view($view = null, $data = [])
    {
        return Nue::content(function (Content $content) use ($view, $data) {
            
            if(isset($data['title'])) {
                $content->title($data['title']);
            }

            $content->view($view, $data);
        });
    }
}

if (!function_exists('nue_exception')) {
    /**
     * Flash error about the exception inside alert
     *
     * @param  string  $e
     */
    function nue_exception($e)
    {
        return NueException::renderException($e);
    }
}
