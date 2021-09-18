<?php 

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

if (!function_exists('imgtest')) {
    function imgtest()
    {
        return "testing works";
    }
}
