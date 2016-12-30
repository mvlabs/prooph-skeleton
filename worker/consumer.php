<?php

declare(strict_types = 1);


namespace MVLabs\ProophSkeleton\Worker;

use Bernard\Consumer;
use Bernard\QueueFactory;
use MVLabs\ProophSkeleton\Factory\PersistentQueueFactoryFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/container.php';

/* @var $consumer Consumer */
$consumer = $container->get(Consumer::class);

/* @var $queueFactory QueueFactory */
$queueFactory = $container->get(QueueFactory::class);

$consumer->consume($queueFactory->create(PersistentQueueFactoryFactory::QUEUE_NAME));
