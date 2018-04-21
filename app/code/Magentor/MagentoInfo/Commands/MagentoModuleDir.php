<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\Command;
use Magentor\Framework\Magento\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoModuleDir extends Command
{

    protected function configure()
    {
        $this->setName('info:module:directory')
            ->setDescription('Displays the Magento\'s module directory.');

        $this->addArgument('module', InputArgument::REQUIRED, 'The module name.', null);
        $this->addArgument('type', InputArgument::OPTIONAL, 'The module directory type.', null);

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
        $type = $input->getArgument('type');
        $name = $input->getArgument('module');

        $output->writeln($this->magentoCommand()->getModuleDir($name, $type));
    }
}
