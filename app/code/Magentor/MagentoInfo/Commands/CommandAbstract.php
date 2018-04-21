<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\CommandAbstract as FrameworkCommandAbstract;

class CommandAbstract extends FrameworkCommandAbstract
{

    /**
     * @return \Magentor\MagentoInfo\Operation\CommandInterface
     */
    protected function magentoCommand()
    {
        return new \Magentor\MagentoInfo\Operation\Command($this->magento());
    }
}
