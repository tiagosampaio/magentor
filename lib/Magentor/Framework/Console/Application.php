<?php

namespace Magentor\Framework\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends \Symfony\Component\Console\Application
{
    
    /**
     * @inheritdoc
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        if (null === $input) {
            $input = new Input\ArgvInput();
        }
    
        if (null === $output) {
            $output = new Output\ConsoleOutput();
        }
        
        return parent::run($input, $output);
    }
}
