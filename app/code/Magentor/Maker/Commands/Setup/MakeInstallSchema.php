<?php

namespace Magentor\Maker\Commands\Setup;

use Magentor\Framework\Assembler\Module\Helper;
use Magentor\Framework\Assembler\Module\SetupInstallSchema;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeInstallSchema extends SetupCommandAbstract
{
    
    protected $name        = 'make:setup:install-schema';
    protected $description = 'Creates a Magento\'s InstallSchema for a given module.';
    
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $vendor = $input->getArgument('vendor');
            $module = $input->getArgument('module');
    
            /** @var SetupInstallSchema $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_SETUP_INSTALL_SCHEMA);
            $assembler->create($vendor, $module)->write();
            
            $output->writeln('Your InstallSchema file was successfully created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
