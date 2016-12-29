<?php

declare(strict_types=1);

use Zend\Expressive\Application;

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$container = require 'config/container.php';

$app = $container->get(Application::class);
$app->run();