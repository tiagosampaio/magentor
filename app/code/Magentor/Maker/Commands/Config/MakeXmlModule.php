<?php

namespace Magentor\Maker\Commands\Config;

use Magentor\Framework\Assembler\Module\Controller;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Template\Xml\Config\Module;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeXmlModule extends CommandConfigAbstract
{
    
    protected $name        = 'make:config:module';
    protected $description = 'Creates a Magento Controller for a given module.';
    
    
    protected function getArguments()
    {
        return [];
    }
    
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $template = new Module('ConfigTest', 'BSeller');
        $template->build();
        $template->addSequence('Magento_Catalog');
        $template->addSequence('Magento_Catalog');
        $template->addSequence('Magento_Backend');
        
        echo (string) $template;
        
        return;
        
        try {
            $vendor = $input->getArgument('vendor');
            $module = $input->getArgument('module');
            $class  = $input->getArgument('class');
            
            /** @var Controller $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_CONTROLLER);
            $assembler->create($vendor, $module, $class)->write();
            
            $output->writeln('Your controller was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
