<?php

return [
    'default' => env('PAYPAL_MODE', 'sandbox'),
    'production' => [
        'url' => 'https://www.paypal.com/cgi-bin/webscr',
        'credentials' => [
            'business' => 'MWP9P6DGC46KS',
            'cmd' => '_donations',
        ]
    ],
    'sandbox' => [
        'url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
        'credentials' => [
            'business' => '3E2ZRKKSR29LG',
            'cmd' => '_donations',
        ]
    ]
];
