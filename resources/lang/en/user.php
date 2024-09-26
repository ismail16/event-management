<?php

use App\Enums\Role;
use App\Enums\UserStatus;

return [
    "status" => [
        UserStatus::ACTIVE => "Active",
        UserStatus::INACTIVE => "Inactive",
    ],
    "roles" => [
        Role::SUPER_ADMIN => "Super Admin",
        Role::STUDENT => "Student",
        Role::MANAGEMENT_ADMIN => "Management Admin",
        Role::EVENT_ADMIN => "Event Admin",
    ],
];
