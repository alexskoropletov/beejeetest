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
        ''     => '\BeeJeeTest\TaskView::showList',
        'list' => '\BeeJeeTest\TaskView::showList',
        'add'  => '\BeeJeeTest\TaskView::addTask',
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