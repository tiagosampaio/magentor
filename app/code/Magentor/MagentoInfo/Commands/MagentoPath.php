<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\Command;
use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoPath extends Command
{

    protected $name = 'info:directory';
    
    
    protected function configure()
    {
        $this->setDescription('Displays the Magento\'s current directory.');
        parent::configure();
    }
    
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(DirectoryRegistrar::getMagentoDir());
    }
}
