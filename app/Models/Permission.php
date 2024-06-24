<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission implements TranslatableContract
{
    use HasFactory, SerializeDate, Translatable;

    public $translatedAttributes = [
        'display_name'
    ];
}
