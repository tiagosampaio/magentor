<?php

namespace Magentor\MagentoInfo\Commands;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoVersion extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('info:version')
            ->setDescription('Displays the Magento\'s version.');

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
        $output->writeln(sprintf('Version %s', $this->magentoCommand()->getVersion()));
    }
}
