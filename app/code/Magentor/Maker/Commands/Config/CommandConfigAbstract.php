<?php

namespace Magentor\Maker\Commands\Config;

use Magentor\Maker\Commands\CommandAbstract;

abstract class CommandConfigAbstract extends CommandAbstract
{
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
}
