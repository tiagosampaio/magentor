<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeHelper extends CommandAbstract
{
    
    protected $name        = 'make:helper';
    protected $description = 'Creates a Magento helper for a given module.';
    
    
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
    
            $builder  = ModuleComponentBuilder::buildHelper($name, $module, $vendor);
            $builder->write();
            
            $output->writeln('Your helper was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
