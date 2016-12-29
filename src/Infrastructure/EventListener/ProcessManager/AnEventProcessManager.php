<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Infrastructure\EventListener\ProcessManager;

use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;

final class AnEventProcessManager
{
    public function __invoke(AnEvent $event)
    {
    }
}
