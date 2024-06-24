<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Settlements
            'panel.settlements.create' => [
                'bg' => [
                    'display_name' => 'Добави населено място'
                ],
                'en' => [
                    'display_name' => 'Create Settlement'
                ]
            ],
            'panel.settlements.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай населено място'
                ],
                'en' => [
                    'display_name' => 'Edit Settlement'
                ]
            ],
            'panel.settlements.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий населено място'
                ],
                'en' => [
                    'display_name' => 'Delete Settlement'
                ]
            ],
            // Town-halls
            'panel.town-halls.index' => [
                'bg' => [
                    'display_name' => 'Списък с кметства'
                ],
                'en' => [
                    'display_name' => 'List Town Halls'
                ]
            ],
            'panel.town-halls.create' => [
                'bg' => [
                    'display_name' => 'Добави кметство'
                ],
                'en' => [
                    'display_name' => 'Create Town Hall'
                ]
            ],
            'panel.town-halls.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай кметство'
                ],
                'en' => [
                    'display_name' => 'Edit Town Hall'
                ]
            ],
            'panel.town-halls.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий кметство'
                ],
                'en' => [
                    'display_name' => 'Delete Town Hall'
                ]
            ],
            // Municipalities
            'panel.municipalities.index' => [
                'bg' => [
                    'display_name' => 'Списък с общини'
                ],
                'en' => [
                    'display_name' => 'List Municipalities'
                ]
            ],
            'panel.municipalities.create' => [
                'bg' => [
                    'display_name' => 'Добави община'
                ],
                'en' => [
                    'display_name' => 'Create Municipality'
                ]
            ],
            'panel.municipalities.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай община'
                ],
                'en' => [
                    'display_name' => 'Edit Municipality'
                ]
            ],
            'panel.municipalities.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий община'
                ],
                'en' => [
                    'display_name' => 'Delete Municipality'
                ]
            ],
            // Districts
            'panel.districts.index' => [
                'bg' => [
                    'display_name' => 'Списък с области'
                ],
                'en' => [
                    'display_name' => 'List Districts'
                ]
            ],
            'panel.districts.create' => [
                'bg' => [
                    'display_name' => 'Добави област'
                ],
                'en' => [
                    'display_name' => 'Create District'
                ]
            ],
            'panel.districts.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай област'
                ],
                'en' => [
                    'display_name' => 'Edit District'
                ]
            ],
            'panel.districts.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий област'
                ],
                'en' => [
                    'display_name' => 'Delete District'
                ]
            ],
            // Regions
            'panel.regions.index' => [
                'bg' => [
                    'display_name' => 'Списък с региони'
                ],
                'en' => [
                    'display_name' => 'List Regions'
                ]
            ],
            'panel.regions.create' => [
                'bg' => [
                    'display_name' => 'Добави регион'
                ],
                'en' => [
                    'display_name' => 'Create Region'
                ]
            ],
            'panel.regions.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай регион'
                ],
                'en' => [
                    'display_name' => 'Edit Region'
                ]
            ],
            'panel.regions.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий регион'
                ],
                'en' => [
                    'display_name' => 'Delete Region'
                ]
            ],
            // Activity Logs
            'panel.activity-logs.index' => [
                'bg' => [
                    'display_name' => 'Списък с активности'
                ],
                'en' => [
                    'display_name' => 'List Activity Logs'
                ]
            ],
            'panel.activity-logs.show' => [
                'bg' => [
                    'display_name' => 'Преглед на активност'
                ],
                'en' => [
                    'display_name' => 'Show Activity Log'
                ]
            ],
            // Users
            'panel.users.index' => [
                'bg' => [
                    'display_name' => 'Списък с потребители'
                ],
                'en' => [
                    'display_name' => 'List Users'
                ]
            ],
            'panel.users.create' => [
                'bg' => [
                    'display_name' => 'Добави потребител'
                ],
                'en' => [
                    'display_name' => 'Create User'
                ]
            ],
            'panel.users.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай потребител'
                ],
                'en' => [
                    'display_name' => 'Edit User'
                ]
            ],
            'panel.users.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий потребител'
                ],
                'en' => [
                    'display_name' => 'Delete User'
                ]
            ],
            'panel.users.restore' => [
                'bg' => [
                    'display_name' => 'Възстанови потребител'
                ],
                'en' => [
                    'display_name' => 'Restore User'
                ]
            ],
            'panel.users.force-delete' => [
                'bg' => [
                    'display_name' => 'Изтрий принудително потребител'
                ],
                'en' => [
                    'display_name' => 'Force Delete User'
                ]
            ],
            // Roles
            'panel.roles.index' => [
                'bg' => [
                    'display_name' => 'Списък с роли'
                ],
                'en' => [
                    'display_name' => 'List Roles'
                ]
            ],
            'panel.roles.create' => [
                'bg' => [
                    'display_name' => 'Добави роля'
                ],
                'en' => [
                    'display_name' => 'Create Role'
                ]
            ],
            'panel.roles.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай роля'
                ],
                'en' => [
                    'display_name' => 'Edit Role'
                ]
            ],
            'panel.roles.destroy' => [
                'bg' => [
                    'display_name' => 'Изтрий роля'
                ],
                'en' => [
                    'display_name' => 'Delete Role'
                ]
            ],
            // Permissions
            'panel.permissions.index' => [
                'bg' => [
                    'display_name' => 'Списък с разрешения'
                ],
                'en' => [
                    'display_name' => 'List Permissions'
                ]
            ],
            'panel.permissions.edit' => [
                'bg' => [
                    'display_name' => 'Редактирай разрешение'
                ],
                'en' => [
                    'display_name' => 'Edit Permission'
                ]
            ]
        ];

        foreach ($permissions as $name => $translations) {
            Permission::updateOrCreate([
                'name' => $name
            ], $translations);
        }
    }
}
