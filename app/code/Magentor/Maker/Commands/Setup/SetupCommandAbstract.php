<?php

namespace Magentor\Maker\Commands\Setup;

use Magentor\Framework\Assembler\Module\Helper;
use Magentor\Framework\Assembler\Module\SetupInstallSchema;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Magentor\Maker\Commands\CommandAbstract;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class SetupCommandAbstract extends CommandAbstract
{
    
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        $arguments = parent::getArguments();
        unset($arguments[0]);
        
        return $arguments;
    }
}
