<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends CommandAbstract
{

    protected $name        = 'make:model';
    protected $description = 'Creates a Magento model for a given module.';
    
    
    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            'create-resources' => [
                'shortcut'    => 'r',
                'description' => "Create the resources with the model.",
            ]
        ];
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
    
            $withResources = (bool) $input->getOption('create-resources');
            
            $assembler = new \Magentor\Framework\Assembler\Module\Model();
            $assembler->create($vendor, $module, $name, [
                'resources' => $withResources
            ]);
            
            $output->writeln('Model was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
    
    
    /**
     * @throws \Magentor\Framework\Exception\GenericException
     */
    protected function buildResourceModel()
    {
        $vendor = $this->getArgument('vendor');
        $module = $this->getArgument('module');
        $name   = $this->getArgument('name');
        
        $builder  = ModuleComponentBuilder::buildResourceModel($name, $module, $vendor);
        $builder->buildDefaultMethod();
        
        $builder->write();
        
        return $builder;
    }
    
    
    /**
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceCollection
     * @throws \Magentor\Framework\Exception\GenericException
     */
    protected function buildResourceCollection(string $modelClass = null, string $resourceModelClass = null)
    {
        $vendor = $this->getArgument('vendor');
        $module = $this->getArgument('module');
        $name   = $this->getArgument('name') . DS . 'Collection';
    
        $builder  = ModuleComponentBuilder::buildResourceCollection($name, $module, $vendor);
        $builder->buildDefaultMethod($modelClass, $resourceModelClass);
        $builder->write();
        
        return $builder;
    }
}
