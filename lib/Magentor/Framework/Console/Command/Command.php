<?php

namespace Magentor\Framework\Console\Command;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{

    /** @var string */
    protected $name = null;


    protected function configure()
    {
        $this->setName($this->name);
    }

}
