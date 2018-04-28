<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\ConfigSource;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeConfigSource extends CommandAbstract
{

    protected $name        = 'make:config-source';
    protected $description = 'Creates a Magento system config source model (admin) for a given module.';
    
    
    /**
     * @return array
     */
    protected function getOptions()
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
        try {
            $vendor = $input->getArgument('vendor');
            $module = $input->getArgument('module');
            $class  = $input->getArgument('class');
    
            /** @var ConfigSource $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_CONFIG_SOURCE);
            $assembler->create($vendor, $module, $class)->write();
            
            $output->writeln('Config source was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
