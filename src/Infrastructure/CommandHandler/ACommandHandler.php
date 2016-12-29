<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Infrastructure\CommandHandler;

use MVLabs\ProophSkeleton\Domain\Aggregate\AnAggregate;
use MVLabs\ProophSkeleton\Domain\Command\ACommand;
use MVLabs\ProophSkeleton\Domain\Repository\Repository;

final class ACommandHandler
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ACommand $aCommand)
    {
        $this->repository->store(AnAggregate::new());
    }
}
