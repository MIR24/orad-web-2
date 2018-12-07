<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ImageRepository
{
    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return array
     */
    public function create(array $attributes = [])
    {
        if (empty($attributes['image'])) {
            throw new FileNotFoundException("No file provided");
        }

        $name = $attributes['image']->hashName();

        if (!empty($attributes['name'])) {
            $name = $attributes['name'].'.'.$attributes['image']->extension();
        }

        $path = $attributes['image']->storeAs('public', $name);
        $url = config('app.url').Storage::url($path);

        return ['url' => $url];
    }
}
