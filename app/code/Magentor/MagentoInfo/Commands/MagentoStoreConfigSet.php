<?php

namespace Magentor\MagentoInfo\Commands;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MagentoStoreConfigSet extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('store:config:set');
        $this->setDescription('Sets a store configuration from Magento database.');
        $this->addArgument('config_path', InputArgument::REQUIRED, 'The config path.', null);
        $this->addArgument('value', InputArgument::REQUIRED, 'The config value.', null);
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
        
        $output->writeln($this->magentoCommand()->getStoreConfig($configPath, $storeId));
    }
}
