<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\Command;
use Magentor\Framework\Magento\Application;
use Magentor\Framework\Magento\Bootstrapper\BootstrapperInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoEdition extends Command
{

    protected $name = 'info:edition';
    
    
    protected function configure()
    {
        $this->setDescription('Displays the Magento\'s edition (Community Edition, Enterprise, etc).');
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
        /** @var BootstrapperInterface $bootstrapper */
        $bootstrapper = Application::getInstance()->getBootstrapper();
        
        $output->writeln([
            sprintf('%s Edition', $bootstrapper->getEdition()),
            sprintf('Version %s', $bootstrapper->getVersion())
        ]);
    }
}
