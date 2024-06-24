<?php

namespace App\Imports\Panel;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param  array  $row
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        return Region::updateOrCreate([
            'code' => $row['region']
        ], [
            'name' => $row['name']
        ]);
    }
}
