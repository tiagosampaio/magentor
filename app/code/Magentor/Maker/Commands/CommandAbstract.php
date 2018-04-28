<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Console\Command\CommandAbstract as FrameworkCommandAbstract;
use Symfony\Component\Console\Input\InputArgument;

abstract class CommandAbstract extends FrameworkCommandAbstract
{
    
    /**
     * @return \Magentor\ModuleInfo\Operation\CommandInterface
     */
    protected function magentoCommand()
    {
        return new \Magentor\ModuleInfo\Operation\Command($this->magento());
    }
    
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        $arguments = [];
        
        $arguments[] = [
            'name'        => 'class',
            'mode'        => InputArgument::REQUIRED,
            'description' => "The module's class name.",
        ];
    
        $vendor = defined('MAGENTO_CURRENT_VENDOR') ? MAGENTO_CURRENT_VENDOR : false;
        $module = defined('MAGENTO_CURRENT_MODULE') ? MAGENTO_CURRENT_MODULE : false;
        
        $mode   = ($vendor && $module) ? InputArgument::OPTIONAL : InputArgument::REQUIRED;
    
        $arguments[] = [
            'name'        => 'module',
            'mode'        => $mode,
            'description' => "The module's name.",
            'default'     => $module ? $module : null,
        ];
        
        $arguments[] = [
            'name'        => 'vendor',
            'mode'        => $mode,
            'description' => "The module's vendor name.",
            'default'     => $vendor ? $vendor : null,
        ];
        
        return $arguments;
    }
}
