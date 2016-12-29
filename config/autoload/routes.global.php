<?php

declare(strict_types=1);

return [
    'routes' => [
        [
            'name' => 'test',
            'path' => '/',
            'middleware' => \MVLabs\ProophSkeleton\Action\Test::class,
        ]
    ],
    'dependencies' => [
        'factories' => [
            \MVLabs\ProophSkeleton\Action\Test::class => \MVLabs\ProophSkeleton\Factory\Action\TestFactory::class
        ]
    ]
];