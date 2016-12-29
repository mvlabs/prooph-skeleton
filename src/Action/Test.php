<?php

namespace MVLabs\ProophSkeleton\Action;

use MVLabs\ProophSkeleton\Domain\Command\ACommand;
use Prooph\ServiceBus\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\TextResponse;

final class Test
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $params = $request->getQueryParams();

        if (!array_key_exists('param', $params)) {
            return new EmptyResponse(404);
        }

        $param = $params['param'];

        $this->commandBus->dispatch(ACommand::fromParameter($param));

        return new TextResponse('hello!');
    }
}
