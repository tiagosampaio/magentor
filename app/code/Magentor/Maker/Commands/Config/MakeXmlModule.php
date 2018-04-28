<?php

namespace Magentor\Maker\Commands\Config;

use Magentor\Framework\Assembler\Module\Controller;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\ModuleConfig;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Code\Template\Xml\Config\Module;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeXmlModule extends CommandConfigAbstract
{
    
    protected $name        = 'make:config:module';
    protected $description = 'Creates a Magento Controller for a given module.';
    
    
    protected function configure()
    {
        $this->addArgument('module', InputArgument::REQUIRED, 'Module name.');
        $this->addArgument('vendor', InputArgument::REQUIRED, 'Vendor name.');
        $this->addArgument('version', InputArgument::OPTIONAL, 'Module version.', '1.0.0');
        
        $this->addOption('sequence', 's', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Sequence.');
        
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
        try {
            $vendor   = (string) $input->getArgument('vendor');
            $module   = (string) $input->getArgument('module');
            $version  = $this->getArgument('version');
            $sequence = $input->getOption('sequence');
            
            /** @var ModuleConfig $builder */
            $builder  = ModuleComponentBuilder::buildXmlConfigModule($module, $vendor, $version, $sequence);
            
            /** @var Module $template */
            $template = $builder->build();
            
            $output->write((string) $template);
            
            $output->writeln('Your controller was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
