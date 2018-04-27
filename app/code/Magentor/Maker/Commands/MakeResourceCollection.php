<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeResourceCollection extends MakeModel
{
    
    protected $name        = 'make:resource-collection';
    protected $description = 'Creates a Magento resource model.';
    
    
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
            $name   = $input->getArgument('name') . DS . 'Collection';
    
            $builder  = ModuleComponentBuilder::buildResourceCollection($name, $module, $vendor);
            $builder->buildDefaultMethod();
            $builder->write();
            
            $output->writeln('Resource Collection was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
