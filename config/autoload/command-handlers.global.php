<?php

declare(strict_types = 1);

// we just define for each command which factory should construct the correct
// handler

return [
    'dependencies' => [
        'factories' => [
            \MVLabs\ProophSkeleton\Domain\Command\ACommand::class => \MVLabs\ProophSkeleton\Factory\Infrastructure\CommandHandler\ACommandHandlerFactory::class,
        ]
    ]
];
