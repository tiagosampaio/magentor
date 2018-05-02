<?php

namespace Magentor\Maker\Commands\Setup;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup\InstallData;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeInstallData extends SetupCommandAbstract
{
    
    protected $name        = 'make:setup:install-data';
    protected $description = 'Creates a Magento\'s InstallSchema for a given module.';
    
    
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
    
            /** @var InstallData $builder */
            $builder = ModuleComponentBuilder::buildSetupInstallData($module, $vendor);
            $builder->write();
            
            $io->success('Your InstallData model was successfully created!');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return;
        }
    }
}
