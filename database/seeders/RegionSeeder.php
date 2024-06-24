<?php

namespace Database\Seeders;

use App\Imports\Panel\RegionsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new RegionsImport, base_path('database/data/Ek_reg2.xlsx'));
    }
}
