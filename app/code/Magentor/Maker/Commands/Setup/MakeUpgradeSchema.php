<?php

namespace Magentor\Maker\Commands\Setup;

use Magentor\Framework\Assembler\Module\Helper;
use Magentor\Framework\Assembler\Module\SetupInstallSchema;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup\UpgradeSchema;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeUpgradeSchema extends SetupCommandAbstract
{
    
    protected $name        = 'make:setup:upgrade-schema';
    protected $description = 'Creates a Magento\'s UpgradeSchema for a given module.';
    
    
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
    
            /** @var UpgradeSchema $builder */
            $builder = ModuleComponentBuilder::buildSetupUpgradeSchema($module, $vendor);
            $builder->write();
    
            $io->success('Your helper was created!');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return;
        }
    }
}
