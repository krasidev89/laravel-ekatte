<?php

namespace App\Imports\Panel;

use App\Models\District;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DistrictsImport implements ToModel, WithHeadingRow
{
    private $regionCodes;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->regionCodes = Region::pluck('id', 'code');
    }

    /**
     * @param  array  $row
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        if (isset($this->regionCodes[$row['region']])) {
            return District::updateOrCreate([
                'code' => $row['oblast']
            ], [
                'ekatte' => $row['ekatte'],
                'name' => $row['name'],
                'region_id' => $this->regionCodes[$row['region']]
            ]);
        }
    }
}
