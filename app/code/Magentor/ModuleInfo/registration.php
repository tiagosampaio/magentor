<?php

use \Magentor\Framework\Component\ModuleRegistrar;

ModuleRegistrar::register('Magentor_ModuleInfo', __DIR__, [
    \Magentor\ModuleInfo\Commands\MagentoModuleDir::class
]);
