<?php

namespace Magentor\Maker\Commands\Setup;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup\UpgradeData;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeUpgradeData extends SetupCommandAbstract
{
    
    protected $name        = 'make:setup:upgrade-data';
    protected $description = 'Creates a Magento\'s setup UpgradeData for a given module.';
    
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        
        try {
            $vendor = $input->getArgument('vendor');
            $module = $input->getArgument('module');
    
            /** @var UpgradeData $builder */
            $builder = ModuleComponentBuilder::buildSetupUpgradeData($module, $vendor);
            $builder->write();
    
            $io->success('Your UpgradeData file was successfully created!');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return;
        }
    }
}
