<?php

namespace MVLabs\ProophSkeleton\Action;

use MVLabs\ProophSkeleton\Domain\Command\ACommand;
use MVLabs\ProophSkeleton\Infrastructure\Reader\Reader;
use Prooph\ServiceBus\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\TextResponse;

final class Test
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var Reader
     */
    private $reader;

    public function __construct(
        CommandBus $commandBus,
        Reader $reader
    ) {
        $this->commandBus = $commandBus;
        $this->reader = $reader;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $params = $request->getQueryParams();

        if (!array_key_exists('param', $params)) {
            return $this->showData();
        }

        $param = $params['param'];

        $this->commandBus->dispatch(ACommand::fromParameter($param));

        return new TextResponse('hello!');
    }

    private function showData() : ResponseInterface
    {
        $data = $this->reader->retrieveAllData();

        return new JsonResponse($data);
    }
}
