<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettlementKind extends Model
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
        'code',
        'name',
        'short_name'
    ];
}
