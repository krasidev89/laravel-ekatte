<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionTranslation extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_name'
    ];
}
