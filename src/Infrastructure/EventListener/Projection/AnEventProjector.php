<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Infrastructure\EventListener\Projection;

use MVLabs\ProophSkeleton\Domain\DomainEvent\AnEvent;

final class AnEventProjector
{
    public function __invoke(AnEvent $event)
    {
    }
}
