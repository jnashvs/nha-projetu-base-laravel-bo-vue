<?php

if (!function_exists('array_satisfies')) {
    /**
     * Returns true if $callable condition is met
     *
     * @param array|\Traversable $traversable
     * @param callable $callable
     * @return bool
     */
    function array_satisfies($traversable, callable $callable)
    {
        foreach ($traversable as $key => $value) {
            if (call_user_func($callable, $value, $key)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('img_cache')) {
    /**
     * Returns image cache url
     *
     * @param string $image
     * @param string $template
     * @return string
     */
    function img_cache($image, $template)
    {
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        return route('imagecache', [$template, ltrim($image, '/')]);
    }
}

if (!function_exists('img_placeholder')) {
    function img_placeholder()
    {
        return new \Illuminate\Support\HtmlString('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
    }
}
