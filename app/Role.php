<?php

namespace App;

use Backpack\PermissionManager\app\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->name == config('permission.super-admin-name')) {
                return false;
            }
        });

        static::saving(function ($model) {
            if ($model->getOriginal('name') == config('permission.super-admin-name')) {
                return false;
            }
        });
    }
}
