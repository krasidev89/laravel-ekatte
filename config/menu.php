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
                    'role_or_permission' => 'admin|panel.settlements.create',
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
                    'role_or_permission' => 'admin|panel.town-halls.index',
                    'text' => 'List Town Halls'
                ],
                'panel.town-halls.create' => [
                    'role_or_permission' => 'admin|panel.town-halls.create',
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
                    'role_or_permission' => 'admin|panel.municipalities.index',
                    'text' => 'List Municipalities'
                ],
                'panel.municipalities.create' => [
                    'role_or_permission' => 'admin|panel.municipalities.create',
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
                    'role_or_permission' => 'admin|panel.districts.index',
                    'text' => 'List Districts'
                ],
                'panel.districts.create' => [
                    'role_or_permission' => 'admin|panel.districts.create',
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
                    'role_or_permission' => 'admin|panel.regions.index',
                    'text' => 'List Regions',
                ],
                'panel.regions.create' => [
                    'role_or_permission' => 'admin|panel.regions.create',
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
                    'role_or_permission' => 'admin|panel.activity-logs.index',
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
                    'role_or_permission' => 'admin|panel.users.index',
                    'text' => 'List Users'
                ],
                'panel.users.create' => [
                    'role_or_permission' => 'admin|panel.users.create',
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
                    'role_or_permission' => 'admin|panel.roles.index',
                    'text' => 'List Roles'
                ],
                'panel.roles.create' => [
                    'role_or_permission' => 'admin|panel.roles.create',
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
                    'role_or_permission' => 'admin|panel.permissions.index',
                    'text' => 'List Permissions'
                ],
            ],
            'extended_routes' => [
                'panel.permissions.edit'
            ]
        ]
    ]
];
