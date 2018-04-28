<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Assembler\Module\ResourceModel;
use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Magento\Module\Component\Type;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeResourceModel extends MakeModel
{
    
    protected $name        = 'make:resource-model';
    protected $description = 'Creates a Magento resource model for a given module.';
    
    
    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            'table' => [
                'shortcut'    => 't',
                'mode'        => InputOption::VALUE_OPTIONAL,
                'description' => "Set the table name for the resource model.",
            ],
            'field' => [
                'shortcut'    => 'f',
                'mode'        => InputOption::VALUE_OPTIONAL,
                'description' => "Set the table identifier field name for the resource model.",
                'default'     => "id",
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
            $class  = $input->getArgument('class');
    
            $table = $input->getOption('table');
            $field = $input->getOption('field');
            
            /** @var ResourceModel $assembler */
            $assembler = ModuleAssemblerBuilder::build(Type::TYPE_RESOURCE_MODEL);
            $assembler->create($vendor, $module, $class, [
                'table' => $table,
                'field' => $field,
            ])->write();
            
            $output->writeln('Resource model was created!');
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
}
