<?php

error_reporting(E_ALL);
#ini_set('display_errors', 1);

// include_once './etc/functions.php';

require_once ROOT . '/app/autoload.php';

\Magentor\Framework\Filesystem\DirectoryRegistrar::register(ROOT);

$bootstrap = \Magentor\Framework\App\Bootstrap::create(ROOT, $_SERVER);
$bootstrap->createApplication()->run();
