<?php

namespace Magentor\ModuleCreator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateModule extends Command
{

    protected function configure()
    {
        $this->setName('module:create');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }

}
