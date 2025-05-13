<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission implements TranslatableContract
{
    use SerializeDate, Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = [
        'display_name'
    ];
}
