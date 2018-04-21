<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\Command;
use Magentor\Framework\Magento\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoBaseUrl extends Command
{

    protected function configure()
    {
        $this->setName('info:base-url');
        $this->setDescription('Displays the Magento\'s base URL.');
        $this->addArgument('secure', InputArgument::OPTIONAL, 'Get the base secure URL rather than unsecure.', null);
        
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
        $secure = $input->getArgument('secure');
        
        switch ($secure) {
            case 'true':
            case '1':
                $secure = true;
                break;
            case 'false':
            case '0':
                $secure = false;
                break;
            default:
                $secure = null;
        }
        
        $output->writeln($this->magentoCommand()->getBaseUrl($secure));
    }
}
