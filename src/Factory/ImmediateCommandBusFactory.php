<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Factory;

use Interop\Container\ContainerInterface;
use Prooph\Common\Event\ActionEvent;
use Prooph\Common\Event\ActionEventEmitter;
use Prooph\Common\Event\ActionEventListenerAggregate;
use Prooph\EventStore\EventStore;
use Prooph\EventStoreBusBridge\TransactionManager;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\MessageBus;
use Prooph\ServiceBus\Plugin\ServiceLocatorPlugin;

final class ImmediateCommandBusFactory
{
    const SERVICE_NAME = 'ImmediateCommandBus';

    public function __invoke(ContainerInterface $container): CommandBus
    {
        $commandBus = new CommandBus();

        // this plugin says that the handler for a command is called as the
        // command itself. This allows to use the command name as a key for the
        // factory of the command handler in the configuration
        $commandBus->utilize(new class implements ActionEventListenerAggregate {
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
                $event->setParam(
                    MessageBus::EVENT_PARAM_MESSAGE_HANDLER,
                    (string) $event->getParam(MessageBus::EVENT_PARAM_MESSAGE_NAME)
                );
            }
        });

        // this plugin is used to retrieve from the dependency injection
        // container the handler for the command
        $commandBus->utilize(new ServiceLocatorPlugin($container));

        // this plugin enables transaction handling based on command dispatch
        $transactionManager = new TransactionManager();
        $transactionManager->setUp($container->get(EventStore::class));

        $commandBus->utilize($transactionManager);

        return $commandBus;
    }
}
