<?php

namespace App\Http\ImageFilters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Promotion implements FilterInterface
{
    /**
     * Applies filter to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image->fit(1260, 960)->encode(null, 80);
    }
}
