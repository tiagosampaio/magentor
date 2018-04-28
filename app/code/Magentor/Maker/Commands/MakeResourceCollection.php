<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\ResourceCollection;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeResourceCollection extends MakeModel
{
    
    protected $name        = 'make:resource-collection';
    protected $description = 'Creates a Magento resource collection for a given module.';
    
    
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
    
            /** @var ResourceCollection $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_RESOURCE_COLLECTION);
            $assembler->create($vendor, $module, $name)->write();
            
            $output->writeln('Resource Collection was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
