<?php

declare(strict_types=1);

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

$cachedConfigFile = 'data/cache/app_config.php';

if (is_file($cachedConfigFile)) {
    return new ArrayObject($cachedConfigFile, ArrayObject::ARRAY_AS_PROPS);
}

$config = [];

// Load configuration from autoload path
foreach (Glob::glob('config/autoload/{{,*.}global,{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
    $config = ArrayUtils::merge($config, include $file);
}

// Cache config if enabled
if (isset($config['config_cache_enabled']) && $config['config_cache_enabled'] === true) {
    file_put_contents($cachedConfigFile, '<?php return ' . var_export($config, true) . ';');
}

// Return an ArrayObject so we can inject the config as a service in Aura.Di
// and still use array checks like ``is_array``.
return new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
