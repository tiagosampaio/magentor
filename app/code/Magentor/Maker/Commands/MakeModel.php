<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\Model;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
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
            
            /** @var Model $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_MODEL);
            $assembler->create($vendor, $module, $name, [
                'resources' => $withResources
            ]);
            
            $output->writeln('Model was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
