<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Domain\Command;

use Prooph\Common\Messaging\Command;

final class ACommand extends Command
{
    /**
     * @var string
     */
    private $parameter;

    private function __construct(string $parameter)
    {
        $this->init();

        $this->parameter = $parameter;
    }

    public static function fromParameter(string $parameter): self
    {
        return new self($parameter);
    }

    public function parameter(): string
    {
        return (string) $this->parameter;
    }

    public function payload(): array
    {
        return [
            'parameter' => $this->parameter
        ];
    }

    public function setPayload(array $payload): void
    {
        $this->parameter = $payload['parameter'];
    }
}
