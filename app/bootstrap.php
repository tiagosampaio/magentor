<?php

error_reporting(E_ALL);
#ini_set('display_errors', 1);

require_once __DIR__ . '/autoload.php';

$bootstrap = \Magentor\Framework\App\Bootstrap::create(ROOT, $_SERVER);

$bootstrap->createApplication()
    ->initialize()
    ->run();
