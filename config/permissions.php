<?php

use App\Enums\Role;

return [
    Role::SUPER_ADMIN => [
        'menu.*',
        'users.*',
        'events.*',
        'participants.*',
    ],
    Role::MANAGEMENT_ADMIN => [
        'menu.*',
        'users.*',
        'menu.setup',
        'events.*',
        'participants.*',
    ],

    Role::STUDENT => [

    ],
    Role::EVENT_ADMIN => [
        'menu.*',
        'menu.setup',
        'events.*',
        'participants.*'
    ],
];
