<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Interop\Container\ContainerInterface;
use Prooph\Common\Event\ActionEvent;
use Prooph\Common\Event\ActionEventEmitter;
use Prooph\Common\Event\ActionEventListenerAggregate;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\MessageBus;

final class ImmediateEventBusFactory
{
    public function __invoke(ContainerInterface $container): EventBus
    {
        $eventBus = new EventBus();

        $eventBus->utilize(new class ($container) implements ActionEventListenerAggregate
            {
                /**
                 * @var ContainerInterface
                 */
                private $container;

                public function __construct(
                    ContainerInterface $container
                ) {
                    $this->container = $container;
                }

                public function attach(ActionEventEmitter $dispatcher)
                {
                    $dispatcher->attachListener(MessageBus::EVENT_ROUTE, [$this, 'onRoute']);
                }

                public function detach(ActionEventEmitter $dispatcher)
                {
                    throw new \BadMethodCallException('Not implemented');
                }

                public function onRoute(ActionEvent $event)
                {
                    $messageName = (string) $event->getParam(MessageBus::EVENT_PARAM_MESSAGE_NAME);

                    $handlers = [];

                    if ($this->container->has($messageName)) {
                        $handlers = $this->container->get($messageName);
                    }

                    $event->setParam(EventBus::EVENT_PARAM_EVENT_LISTENERS, $handlers);
                }
            }
        );

        return $eventBus;
    }
}
