<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Model;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Nette\PhpGenerator\Method;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends CommandAbstract
{

    protected $name        = 'make:model';
    protected $description = 'Creates a Magento model.';
    protected $builder     = ModuleComponentBuilder::TYPE_MODEL;
    
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        return [
            'vendor' => [
                'mode'        => InputArgument::REQUIRED,
                'description' => "The module's vendor name.",
            ],
            'module' => [
                'mode'        => InputArgument::REQUIRED,
                'description' => "The module's name.",
            ],
            'name' => [
                'mode'        => InputArgument::REQUIRED,
                'description' => "The module's class name.",
            ],
        ];
    }
    
    
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
    
            /** @var Model $builder */
            $builder = ModuleComponentBuilder::buildModel($name, $module, $vendor);
            
            $output->writeln('Model was created!');
    
            $resourceClass = null;
            $withResources = $input->getOption('create-resources');
            
            if (true === $withResources) {
                $resourceClass = $this->buildResourceModel()
                                      ->classResolver()
                                      ->getFullClassName(true, true);
            }
    
            $builder->buildDefaultMethod($resourceClass);
    
            $builder->write();
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
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    protected function getBuilder(string $name, string $module, string $vendor)
    {
        return ModuleComponentBuilder::build($this->builder, [$name, $module, $vendor]);
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
}
