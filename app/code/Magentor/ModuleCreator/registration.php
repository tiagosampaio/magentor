<?php

use \Magentor\Framework\Component\ModuleRegistrar;

ModuleRegistrar::register('Magentor_ModuleCreator', __DIR__, [
    \Magentor\ModuleCreator\Commands\CreateModule::class
]);
