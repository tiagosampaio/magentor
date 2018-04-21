<?php

namespace Magentor\MagentoInfo\Commands;

use Magentor\Framework\Console\Command\Command;
use Magentor\Framework\Magento\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoStoreConfig extends Command
{

    protected $name = 'info:store-config';
    
    
    protected function configure()
    {
        $this->setDescription('Gets a store configuration from Magento database.');
        $this->addArgument('config_path', InputArgument::REQUIRED, 'The config path.', null);
        $this->addArgument('store_id', InputArgument::OPTIONAL, 'Sets the store_id.', null);
        
        parent::configure();
    }
    
    
    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configPath = (string) $input->getArgument('config_path');
        $storeId    = (int)    $input->getArgument('store_id');
        
        $output->writeln(Application::getInstance()->getBootstrapper()->getStoreConfig($configPath, $storeId));
    }
}
