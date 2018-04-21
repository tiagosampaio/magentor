<?php

namespace Magentor\MagentoInfo\Commands;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoIsInstalled extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('info:installed')
            ->setDescription('Displays if Magento\'s is installed.');

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
        $output->writeln(sprintf('Version %s', $this->magentoCommand()->isInstalled()));
    }
}
