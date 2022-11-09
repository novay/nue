<?php

namespace Novay\Nue\Traits\Assets;

trait Html
{
    /**
     * @var string
     */
    public static $metaTitle;

    /**
     * @var array
     */
    public static $minifyIgnores = [];

    /**
     * Set nue title.
     *
     * @param string $title
     *
     * @return void
     */
    public static function setTitle($title)
    {
        self::$metaTitle = $title;
    }

    /**
     * Get nue title.
     *
     * @return string
     */
    public function title()
    {
        return self::$metaTitle ? self::$metaTitle : config('nue.title');
    }

    /**
     * @param string $assets
     * @param bool   $ignore
     */
    public static function ignoreMinify($assets, $ignore = true)
    {
        if (!$ignore) {
            static::$minifyIgnores[] = $assets;
        }
    }
}