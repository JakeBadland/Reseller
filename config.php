<?php

return [
    'autoloads' => [
        'Libs',
        'Classes',
        'Objects',
        'Helpers'
    ],

    'db' => [
        'host'          => 'localhost',
        'user'          => 'root',
        'password'      => '',
        'db_name'       => 'reseller'
    ],

    'prom' => [
        'token'    => '0bdfa79dd84a89d0ce54e02eed6a212d38c20e9b',
        'api_url'      => 'my.prom.ua',
    ],

    'settings' => [
        'xls_file'      => 'Data' . DS . 'Юг 2022.xlsx',
        'xls_dir'       => 'Data' . DS . 'worksheets',
    ],
];