<?php

return [
    'db'     => [
        'host'     => 'localhost',
        'database' => 'beejee',
        'user'     => 'beejee',
        'password' => '123',
        'charset'  => 'utf8',
    ],
    'routes' => [
        ''     => [
            'class'  => '\BeeJeeTest\TaskView',
            'method' => 'showList',
        ],
        'list' => [
            'class'  => '\BeeJeeTest\TaskView',
            'method' => 'showList',
        ],
        'add'  => [
            'class'  => '\BeeJeeTest\TaskView',
            'method' => 'addTask',
        ],
    ],
    'list'   => [
        'on_page' => 3,
    ],
    'images' => [
        'format' => [
            'JPG',
            'GIF',
            'PNG',
        ],
        'width'  => 320,
        'height' => 240,
    ],
];