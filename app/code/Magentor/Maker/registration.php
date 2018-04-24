<?php

use \Magentor\Framework\Component\ModuleRegistrar;

ModuleRegistrar::register('Magentor_Maker', __DIR__, [
    \Magentor\Maker\Commands\MakeModel::class
]);
