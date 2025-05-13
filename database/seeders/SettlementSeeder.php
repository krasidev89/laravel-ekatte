<?php

namespace Database\Seeders;

use App\Imports\Panel\SettlementsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class SettlementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new SettlementsImport, base_path('database/data/Ek_atte.xlsx'));
    }
}
