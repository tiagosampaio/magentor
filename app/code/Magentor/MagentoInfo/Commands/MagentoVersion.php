<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\Command;
use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Magentor\Framework\Magento\Application;
use Magentor\Framework\Magento\ApplicationInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoVersion extends Command
{

    protected $name = 'info:version';


    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(Application::getInstance()->getBootstrapper()->getVersion());
    }
}
