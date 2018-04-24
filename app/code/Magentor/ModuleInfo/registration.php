<?php

use \Magentor\Framework\Component\ModuleRegistrar;

$moduleOptions = [
    'enabled' => false
];

ModuleRegistrar::register('Magentor_ModuleInfo', __DIR__, [
    \Magentor\ModuleInfo\Commands\MagentoModuleDir::class
], $moduleOptions);
