<?php

use \Magentor\Framework\Component\ModuleRegistrar;

$moduleOptions = [
    'enabled' => false
];

ModuleRegistrar::register('Magentor_MagentoInfo', __DIR__, [
    \Magentor\MagentoInfo\Commands\MagentoPath::class,
    \Magentor\MagentoInfo\Commands\MagentoVersion::class,
    \Magentor\MagentoInfo\Commands\MagentoEdition::class,
    \Magentor\MagentoInfo\Commands\MagentoBaseUrl::class,
    \Magentor\MagentoInfo\Commands\MagentoStoreConfigGet::class,
    \Magentor\MagentoInfo\Commands\MagentoStoreConfigSet::class,
    \Magentor\MagentoInfo\Commands\MagentoIsInstalled::class,
], $moduleOptions);
