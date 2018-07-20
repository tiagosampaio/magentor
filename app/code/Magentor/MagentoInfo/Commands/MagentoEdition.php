<?php

namespace Magentor\MagentoInfo\Commands;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoEdition extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('info:edition');
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
        $output->writeln([
            sprintf('%s Edition', $this->magentoCommand()->getEdition())
        ]);
        
        /** @var MagentoVersion $command */
        $command = $this->getApplication()->find('info:version');
    
        try {
            $command->run($input, $output);
        } catch (\Exception $e) {
        }
    }
}
