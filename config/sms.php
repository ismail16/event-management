<?php

return [

    "default" => env("SMS_DRIVER", "log"),

    "clients" => [
        "log" => [
            "driver" => "log"
        ],

        "email" => [
            "driver" => "email"
        ],

        "mobireach" => [
            "driver" => "mobireach",
            "user_name" => env("MOBI_REACH_USER_NAME", null),
            "password" => env("MOBI_REACH_PASSWORD", null),
            "from" => env("MOBI_REACH_FROM", null),
            "api_base" => env('MOBI_REACH_API_BASE', 'https://api.mobireach.com.bd/'),
        ],
    ],
];
