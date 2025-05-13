<?php

namespace Database\Seeders;

use App\Imports\Panel\MunicipalitiesImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new MunicipalitiesImport, base_path('database/data/Ek_obst.xlsx'));
    }
}
