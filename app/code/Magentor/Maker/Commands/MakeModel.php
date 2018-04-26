<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Magentor\Framework\Filesystem\Filesystem;

class MakeModel extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('make:model')
            ->setDescription('Creates a Magento model.');

//        $this->addArgument('vendor', InputArgument::REQUIRED, 'The module\'s vendor name');
//        $this->addArgument('module', InputArgument::REQUIRED, 'The module\'s name.');
//        $this->addArgument('name', InputArgument::REQUIRED, 'The module\'s model name.');
    
        $this->addOption('create-resources', 'r', null, 'Create the resources with the model.');
        
        parent::configure();
    }


    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $vendor = $input->getArgument('vendor');
//        $module = $input->getArgument('module');
//        $name   = $input->getArgument('name');
        
        $vendor = $this->ask($input, $output, 'Which vendor? ');
        $module = $this->ask($input, $output, 'Which module? ', 'SkyHub');
        $name   = $this->ask($input, $output, 'Model\'s class name? ', 'Preset');
        
        $withResources = $input->getOption('create-resources');
        
        try {
            $maker = new \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model($name, $module, $vendor);
            
            /** @var PhpClassBuilder $file */
            $builder = $maker->build();
            
            $filesystem = new Filesystem();
            $filesystem->dumpFile($maker->getFilename(), (string) $builder);
    
            $output->writeln('Model was created!');
            
            if (true === $withResources) {
                /** @var MakeResourceModel $command */
                $command = $this->getApplication()->find('make:resource-model');
                
                $arguments = [
                    'vendor' => $vendor,
                    'module' => $module,
                    'name'   => $name,
                ];
                
                $newInput = new ArrayInput($arguments);
    
                $command->run($newInput, $output);
            }
        } catch (\Exception $e) {
            $output->writeln(['Error', $e->getMessage()]);
            return;
        }
    }
    
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @param string          $message
     * @param string|null     $default
     *
     * @return mixed
     */
    protected function ask(InputInterface $input, OutputInterface $output, $message, $default = null)
    {
        $question = new Question($message, $default);
        
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $answer = $helper->ask($input, $output, $question);
        
        return $answer;
    }
}
