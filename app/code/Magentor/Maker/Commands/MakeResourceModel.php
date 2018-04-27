<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeResourceModel extends MakeModel
{
    
    protected $name        = 'make:resource-model';
    protected $description = 'Creates a Magento resource model.';
    protected $builder     = ModuleComponentBuilder::TYPE_RESOURCE_MODEL;
    
    
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
            $name   = $input->getArgument('name');
    
            $this->getBuilder($name, $module, $vendor)->write();
            
            $output->writeln('Resource model was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model
     */
    protected function getMaker(string $name, string $module, string $vendor)
    {
        return new \Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceModel($name, $module, $vendor);
    }
}
