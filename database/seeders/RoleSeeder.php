<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'readonly' => 1
            ], [
                'name' => 'manager',
                'readonly' => 1,
                'permissions' => [
                    // Settlements
                    'panel.settlements.create',
                    'panel.settlements.edit',
                    'panel.settlements.destroy',
                    // Town-halls
                    'panel.town-halls.index',
                    'panel.town-halls.create',
                    'panel.town-halls.edit',
                    'panel.town-halls.destroy',
                    // Municipalities
                    'panel.municipalities.index',
                    'panel.municipalities.create',
                    'panel.municipalities.edit',
                    'panel.municipalities.destroy',
                    // Districts
                    'panel.districts.index',
                    'panel.districts.create',
                    'panel.districts.edit',
                    'panel.districts.destroy',
                    // Regions
                    'panel.regions.index',
                    'panel.regions.create',
                    'panel.regions.edit',
                    'panel.regions.destroy',
                    // Activity Logs
                    'panel.activity-logs.index',
                    'panel.activity-logs.show',
                    // Users
                    'panel.users.index',
                    // Roles
                    'panel.roles.index',
                    // Permissions
                    'panel.permissions.index'
                ]
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role['name']
            ], [
                'readonly' => $role['readonly']
            ])->syncPermissions($role['permissions'] ?? []);
        }
    }
}
