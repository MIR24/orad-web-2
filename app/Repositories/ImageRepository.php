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
        if (empty($attributes['file'])) {
            throw new FileNotFoundException("No file provided");
        }

        $name = $attributes['file']->hashName();

        if (!empty($attributes['file']->name)) {
            $name = $attributes['name']->name;
        }

        Storage::disk('public_images')->put($name, file_get_contents($attributes['file']));

        return ['url' => Storage::disk('public_images')->url($name)];
    }
}
