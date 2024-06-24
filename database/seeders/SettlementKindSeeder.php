<?php

namespace Database\Seeders;

use App\Models\SettlementKind;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettlementKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettlementKind::upsert([
            [
                'code' => 1,
                'name' => 'град',
                'short_name' => 'гр.'
            ], [
                'code' => 3,
                'name' => 'село',
                'short_name' => 'с.'
            ], [
                'code' => 7,
                'name' => 'манастир',
                'short_name' => 'ман.'
            ]
        ], [
            'code'
        ], [
            'name',
            'short_name'
        ]);
    }
}
