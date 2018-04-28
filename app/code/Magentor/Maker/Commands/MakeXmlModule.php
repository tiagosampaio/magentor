<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\Controller;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeXmlModule extends CommandAbstract
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
        $xml = new \SimpleXMLElement("<config/>", LIBXML_NOERROR, false, 'ws', true);
        $xml->addAttribute('xmlns:xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->addAttribute('xmlns:xsi:noNamespaceSchemaLocation', 'urn:magento:framework:Module/etc/module.xsd');
        
        $module = $xml->addChild('module');
        $module->addAttribute('name', 'BitTools_SkyHub');
        $module->addAttribute('setup_version', '1.0.0');
    
        $module->addChild('sequence');
        
        $content = $xml->asXML();
        echo $content;
        
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
