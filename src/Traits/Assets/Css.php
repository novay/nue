<?php

namespace Novay\Nue\Traits\Assets;

trait Css
{
    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $style = [];

    /**
     * Add css or get all css.
     *
     * @param null $css
     * @param bool $minify
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function css($css = null, $minify = true)
    {
        static::ignoreMinify($css, $minify);

        if (!is_null($css)) {
            return self::$css = array_merge(self::$css, (array) $css);
        }

        if (!$css = static::getMinifiedCss()) {
            $css = static::$css;
        }

        $css = array_filter(array_unique($css));

        $html = '';
        foreach($css as $temp):
            $html .= '<link rel="stylesheet" href="'. nue_asset($temp) .'">';
        endforeach;

        return $html;
    }

    /**
     * @param string $style
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function style($style = '')
    {
        if (!empty($style)) {
            return self::$style = array_merge(self::$style, (array) $style);
        }

        $style = collect(static::$style)
            ->unique()
            ->map(function ($line) {
                return preg_replace('/\s+/', ' ', $line);
            });

        $html = '';
        foreach($style as $i => $temp):
            $html .= '<link rel="stylesheet" href="'. nue_asset($temp['href']) .'">';
        endforeach;

        // [
        //     'rel' => 'preload', 
        //     'href' => 'https://aws.btekno.id/templates/nue/css/theme.min.css', 
        //     'data-nue-appearance' => 'default', 
        //     'as' => 'style'
        // ], 

        return $html;
    }

    /**
     * @return bool|mixed
     */
    protected static function getMinifiedCss()
    {
        if (!config('nue.minify_assets') || !file_exists(public_path(static::$manifest))) {
            return false;
        }

        return static::getManifestData('css');
    }
}