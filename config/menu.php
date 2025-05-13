<?php

return [
    'panel' => [
        'settlements' => [
            'text' => 'Settlements',
            'routes' => [
                'panel.settlements.index' => [
                    'text' => 'List Settlements'
                ],
                'panel.settlements.create' => [
                    'can' => ['create', \App\Models\Settlement::class],
                    'text' => 'Create Settlement'
                ]
            ],
            'extended_routes' => [
                'panel.settlements.edit'
            ]
        ],
        'town-halls' => [
            'text' => 'Town Halls',
            'routes' => [
                'panel.town-halls.index' => [
                    'can' => ['viewAny', \App\Models\TownHall::class],
                    'text' => 'List Town Halls'
                ],
                'panel.town-halls.create' => [
                    'can' => ['create', \App\Models\TownHall::class],
                    'text' => 'Create Town Hall'
                ]
            ],
            'extended_routes' => [
                'panel.town-halls.edit'
            ]
        ],
        'municipalities' => [
            'text' => 'Municipalities',
            'routes' => [
                'panel.municipalities.index' => [
                    'can' => ['viewAny', \App\Models\Municipality::class],
                    'text' => 'List Municipalities'
                ],
                'panel.municipalities.create' => [
                    'can' => ['create', \App\Models\Municipality::class],
                    'text' => 'Create Municipality'
                ]
            ],
            'extended_routes' => [
                'panel.municipalities.edit'
            ]
        ],
        'districts' => [
            'text' => 'Districts',
            'routes' => [
                'panel.districts.index' => [
                    'can' => ['viewAny', \App\Models\District::class],
                    'text' => 'List Districts'
                ],
                'panel.districts.create' => [
                    'can' => ['create', \App\Models\District::class],
                    'text' => 'Create District'
                ]
            ],
            'extended_routes' => [
                'panel.districts.edit'
            ]
        ],
        'regions' => [
            'text' => 'Regions',
            'routes' => [
                'panel.regions.index' => [
                    'can' => ['viewAny', \App\Models\Region::class],
                    'text' => 'List Regions',
                ],
                'panel.regions.create' => [
                    'can' => ['create', \App\Models\Region::class],
                    'text' => 'Create Region'
                ]
            ],
            'extended_routes' => [
                'panel.regions.edit'
            ]
        ],
        'activity-logs' => [
            'text' => 'Activity Logs',
            'routes' => [
                'panel.activity-logs.index' => [
                    'can' => ['viewAny', \App\Models\ActivityLog::class],
                    'text' => 'List Activity Logs'
                ]
            ],
            'extended_routes' => [
                'panel.activity-logs.show'
            ]
        ],
        'users' => [
            'text' => 'Users',
            'routes' => [
                'panel.users.index' => [
                    'can' => ['viewAny', \App\Models\User::class],
                    'text' => 'List Users'
                ],
                'panel.users.create' => [
                    'can' => ['create', \App\Models\User::class],
                    'text' => 'Create User'
                ]
            ],
            'extended_routes' => [
                'panel.users.edit'
            ]
        ],
        'roles' => [
            'text' => 'Roles',
            'routes' => [
                'panel.roles.index' => [
                    'can' => ['viewAny', \App\Models\Role::class],
                    'text' => 'List Roles'
                ],
                'panel.roles.create' => [
                    'can' => ['create', \App\Models\Role::class],
                    'text' => 'Create Role'
                ]
            ],
            'extended_routes' => [
                'panel.roles.edit'
            ]
        ],
        'permissions' => [
            'text' => 'Permissions',
            'routes' => [
                'panel.permissions.index' => [
                    'can' => ['viewAny', \App\Models\Permission::class],
                    'text' => 'List Permissions'
                ],
            ],
            'extended_routes' => [
                'panel.permissions.edit'
            ]
        ]
    ]
];
