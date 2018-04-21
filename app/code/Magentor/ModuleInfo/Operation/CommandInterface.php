<?php

namespace Magentor\ModuleInfo\Operation;


use Magentor\Framework\Exception\GenericException;

interface CommandInterface
{

    /**
     * @var string $name
     * @var string $type
     *
     * @return string
     *
     * @throws GenericException
     */
    public function getModuleDir($name, $type = 'etc');
}
