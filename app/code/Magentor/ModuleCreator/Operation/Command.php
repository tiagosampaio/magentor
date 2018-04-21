<?php

namespace Magentor\ModuleCreator\Operation;


class Command extends \Magentor\Framework\Magento\Operation\CommandAbstract implements CommandInterface
{

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createModule()
    {
//        return $this->executeCommand(Method\GetModuleDir::class, [$name, $type]);
    }
}
