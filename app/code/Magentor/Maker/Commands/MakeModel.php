<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magentor\Framework\Filesystem\Filesystem;

class MakeModel extends CommandAbstract
{

    protected $name        = 'make:model';
    protected $description = 'Creates a Magento model.';
    
    
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
                'mode'        => InputArgument::OPTIONAL,
                'description' => "Create the resources with the model.",
                'default'     => null,
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
            $this->buildFile($input);
            $output->writeln('Model was created!');
    
            $withResources = $input->getOption('create-resources');
            
            if (true === $withResources) {
                $this->executeNestedCommands($output, $input);
            }
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
    
    
    /**
     * @param InputInterface $input
     *
     * @return $this
     */
    protected function buildFile(InputInterface $input)
    {
        $vendor = $input->getArgument('vendor');
        $module = $input->getArgument('module');
        $name   = $input->getArgument('name');
        
        /** @var \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model $maker */
        $maker = $this->getMaker($name, $module, $vendor);
    
        /** @var PhpClassBuilder $file */
        $builder = $maker->build();
    
        $filesystem = new Filesystem();
        $filesystem->dumpFile($maker->getFilename(), (string) $builder);
        
        return $this;
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
        return new \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model($name, $module, $vendor);
    }
    
    
    /**
     * @param OutputInterface $output
     * @param InputInterface  $input
     *
     * @throws \Exception
     */
    protected function executeNestedCommands(OutputInterface $output, InputInterface $input)
    {
        $vendor = $input->getArgument('vendor');
        $module = $input->getArgument('module');
        $name   = $input->getArgument('name');
        
        /** @var MakeResourceModel $command */
        $command = $this->getApplication()->find('make:resource-model');
    
        $newInput = new ArrayInput([
            'vendor' => $vendor,
            'module' => $module,
            'name'   => $name,
        ]);
    
        $command->run($newInput, $output);
    }
}
