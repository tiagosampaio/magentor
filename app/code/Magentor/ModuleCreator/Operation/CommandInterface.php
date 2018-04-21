<?php

namespace Magentor\ModuleCreator\Operation;


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
    public function createModule();
}
