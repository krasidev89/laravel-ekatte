<?php

namespace Database\Seeders;

use App\Imports\Panel\DistrictsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new DistrictsImport, base_path('database/data/Ek_obl.xlsx'));
    }
}
