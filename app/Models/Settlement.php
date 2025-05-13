<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Settlement extends Model
{
    use SerializeDate, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ekatte',
        'name',
        'settlement_kind_id',
        'town_hall_id',
        'municipality_id',
        'district_id'
    ];

    public function settlement_kind()
    {
        return $this->belongsTo(SettlementKind::class, 'settlement_kind_id', 'id');
    }

    public function town_hall()
    {
        return $this->belongsTo(TownHall::class, 'town_hall_id', 'id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly([
            'ekatte',
            'name',
            'settlement_kind.name',
            'district.name',
            'municipality.name',
            'town_hall.name'
        ]);
    }
}
