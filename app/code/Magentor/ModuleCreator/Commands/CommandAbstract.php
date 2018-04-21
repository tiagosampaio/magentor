<?php

namespace Magentor\ModuleCreator\Commands;

use Magentor\Framework\Console\Command\CommandAbstract as FrameworkCommandAbstract;

class CommandAbstract extends FrameworkCommandAbstract
{

    /**
     * @return \Magentor\ModuleCreator\Operation\CommandInterface
     */
    protected function magentoCommand()
    {
        return new \Magentor\ModuleCreator\Operation\Command($this->magento());
    }
}
