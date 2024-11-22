<?php

return [

    'default_alert' => [
        'email' => env('DEFAULT_ALERT_EMAIL'),
    ],

    'admin_alert' => [
        'email' => env('ADMIN_ALERT_EMAIL'),
        'mobile' => env('ADMIN_ALERT_MOBILE'),
    ],

    'ticket_alert_email' => env('TICKET_ALERT_EMAIL'),

];
