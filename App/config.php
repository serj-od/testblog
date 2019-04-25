<?php

return [
    'mysql' => [
        "user" => "test",
        "password" => "test",
        "dbname" => "testblog",
        "host" => "127.0.0.1",
    ],
    'routes' => [
        'posts/([\d]+)' => 'posts/show/$1',
        'posts/delete/([\d]+)' => 'posts/delete/$1',
        'posts/edit/([\d]+)' => 'posts/edit/$1',
        'posts/save/([\d]+)' => 'posts/save/$1',
        'posts/list' => 'posts/index',
        'posts/new/save' => 'posts/newPost',
        'posts/new' => 'posts/add',
        'posts' => 'posts/index',
        'sendLogin' => 'users/sendLogin',
        'login' => 'users/showLogin',
        'logout' => 'users/logout',
        'register' => 'users/showRegForm',
        'sendRegister' => 'users/sendRegister',
        '' => 'posts/index',
    ],
    'template_dir' => '/Views',
    'restrict' => ['save', 'edit', 'delete', 'add', 'newPost'],
];