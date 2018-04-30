<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\App\Environment;
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
        
        $arguments[0] = [
            'name'        => 'class',
            'mode'        => InputArgument::REQUIRED,
            'description' => "The module's class name.",
        ];
    
        $vendor = Environment::getCurrentMagentoVendor();
        $module = Environment::getCurrentMagentoModule();
        
        $mode   = ($vendor && $module) ? InputArgument::OPTIONAL : InputArgument::REQUIRED;
    
        $arguments[1] = [
            'name'        => 'module',
            'mode'        => $mode,
            'description' => "The module's name.",
            'default'     => $module ? $module : null,
        ];
        
        $arguments[2] = [
            'name'        => 'vendor',
            'mode'        => $mode,
            'description' => "The module's vendor name.",
            'default'     => $vendor ? $vendor : null,
        ];
        
        return $arguments;
    }
}
