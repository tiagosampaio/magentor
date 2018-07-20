<?php

namespace Magentor\ModuleInfo\Operation;

class Command extends \Magentor\Framework\Magento\Operation\CommandAbstract implements CommandInterface
{

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getModuleDir($name, $type = 'etc')
    {
        return $this->executeCommand(Method\GetModuleDir::class, [$name, $type]);
    }
}
