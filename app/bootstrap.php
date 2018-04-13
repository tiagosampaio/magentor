<?php

error_reporting(E_ALL);
#ini_set('display_errors', 1);

// include_once './etc/functions.php';

define('IS_PHAR', (bool) Phar::running());

if (IS_PHAR) {
    define('ROOT', 'phar://magentor.phar');
} else {
    define('ROOT', dirname(__DIR__));
}

require_once ROOT . '/app/autoload.php';

\Magentor\Framework\Filesystem\DirectoryRegistrar::register(ROOT);

$bootstrap = \Magentor\Framework\App\Bootstrap::create(ROOT, $_SERVER);
$bootstrap->createApplication()->run();
