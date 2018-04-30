<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\Helper;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeInstallSchema extends CommandAbstract
{
    
    protected $name        = 'make:install-schema';
    protected $description = 'Creates a Magento\'s InstallSchema for a given module.';
    
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        $arguments = parent::getArguments();
        unset($arguments[0]);
        
        return $arguments;
    }
    
    
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
    
            /** @var Helper $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_SETUP_INSTALL_SCHEMA);
            $assembler->create($vendor, $module)->write();
            
            $output->writeln('Your helper was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
