<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\Helper;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeHelper extends CommandAbstract
{
    
    protected $name        = 'make:helper';
    protected $description = 'Creates a Magento Helper for a given module.';
    
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        $arguments = parent::getArguments();
        $arguments['name']['mode'] = InputArgument::OPTIONAL;
        
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
            $name   = $input->getArgument('name');
            
            if (empty($name)) {
                $name = 'Data';
            }
    
            /** @var Helper $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_HELPER);
            $assembler->create($vendor, $module, $name)->write();
            
            $output->writeln('Your helper was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
