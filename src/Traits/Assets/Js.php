<?php

namespace Novay\Nue\Traits\Assets;

trait Js
{
    /**
     * @var array
     */
    public static $js = [];

    /**
     * @var array
     */
    public static $headerJs = [];

	/**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $deferredScript = [];

    /**
     * Add js or get all js.
     *
     * @param null $js
     * @param bool $minify
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function js($js = null, $minify = true)
    {
        static::ignoreMinify($js, $minify);

        if (!is_null($js)) {
            return self::$js = array_merge(self::$js, (array) $js);
        }

        if (!$js = static::getMinifiedJs()) {
            $js = static::$js;
        }

        $js = array_filter(array_unique($js));

        $html = '';
        foreach($js as $temp):
            $html .= '<script src="'. $temp .'"></script>';
        endforeach;

        return $html;
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function headerJs($js = null)
    {
        if (!is_null($js)) {
            return self::$headerJs = array_merge(self::$headerJs, (array) $js);
        }

        $js = array_unique(static::$headerJs);

        $html = '';
        foreach($js as $temp):
            $html .= '<script src="'. nue_asset($temp) .'"></script>';
        endforeach;

        return $html;
    }

    /**
     * @param string $script
     * @param bool   $deferred
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function script($script = '', $deferred = false)
    {
        if (!empty($script)) {
            if ($deferred) {
                return self::$deferredScript = array_merge(self::$deferredScript, (array) $script);
            }

            return self::$script = array_merge(self::$script, (array) $script);
        }

        $script = collect(static::$script)
            ->merge(static::$deferredScript)
            ->unique()
            ->map(function ($line) {
                return $line;
                //@see https://stackoverflow.com/questions/19509863/how-to-remove-js-comments-using-php
                $pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
                $line = preg_replace($pattern, '', $line);

                return preg_replace('/\s+/', ' ', $line);
            });

        return view('nue::assets.script', compact('script'));
    }

    /**
     * @return bool|mixed
     */
    protected static function getMinifiedJs()
    {
        if (!config('nue.minify_assets') || !file_exists(public_path(static::$manifest))) {
            return false;
        }

        return static::getManifestData('js');
    }
}