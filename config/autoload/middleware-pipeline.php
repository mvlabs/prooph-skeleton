<?php

declare(strict_types=1);

return [
    'middleware_pipeline' => [
        'routing' => [
            'middleware' => [
                \Zend\Expressive\Container\ApplicationFactory::ROUTING_MIDDLEWARE,
                \Zend\Expressive\Container\ApplicationFactory::DISPATCH_MIDDLEWARE
            ]
        ]
    ]
];
