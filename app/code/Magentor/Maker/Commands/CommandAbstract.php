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
        return [
            'vendor' => [
                'mode'        => InputArgument::REQUIRED,
                'description' => "The module's vendor name.",
            ],
            'module' => [
                'mode'        => InputArgument::REQUIRED,
                'description' => "The module's name.",
            ],
            'name' => [
                'mode'        => InputArgument::REQUIRED,
                'description' => "The module's class name.",
            ],
        ];
    }
}
