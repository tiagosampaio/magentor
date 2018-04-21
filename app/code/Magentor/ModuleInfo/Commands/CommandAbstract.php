<?php

namespace Magentor\ModuleInfo\Commands;

use Magentor\Framework\Console\Command\CommandAbstract as FrameworkCommandAbstract;

class CommandAbstract extends FrameworkCommandAbstract
{

    /**
     * @return \Magentor\ModuleInfo\Operation\CommandInterface
     */
    protected function magentoCommand()
    {
        return new \Magentor\ModuleInfo\Operation\Command($this->magento());
    }
}
