<?php

return [
    'test_mode' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
            'on_text'       => 'TEST',
            'on_color'      => 'warning',
            'off_text'      => 'LIVE',
            'off_color'     => 'success'
        ]
    ],
    'username'  => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted',
        'config'   => [
            'show_text' => true
        ]
    ],
    'password'  => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted'
    ],
    'signature' => [
        'required' => true,
        'type'     => 'anomaly.field_type.encrypted'
    ]
];

