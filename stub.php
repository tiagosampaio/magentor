#!/usr/bin/env php
<?php

$pharName = 'magentor.phar';

Phar::mapPhar($pharName);

define('IS_PHAR', (bool) Phar::running());
define('ROOT',    "phar://{$pharName}");

require_once ROOT . '/app/bootstrap.php';

__HALT_COMPILER();
