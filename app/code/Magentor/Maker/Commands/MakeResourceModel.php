<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Magentor\Framework\Filesystem\Filesystem;

class MakeResourceModel extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('make:resource-model')
            ->setDescription('Creates a Magento resource model.');

        $this->addArgument('vendor', InputArgument::OPTIONAL, 'The module\'s vendor name');
        $this->addArgument('module', InputArgument::OPTIONAL, 'The module\'s name.');
        $this->addArgument('name', InputArgument::OPTIONAL, 'The module\'s model name.');

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
        $vendor = $input->getArgument('vendor');
        $module = $input->getArgument('module');
        $name   = $input->getArgument('name');
        
        if (!$vendor) {
            $vendor = $this->ask($input, $output, 'Which vendor? ');
        }
    
        if (!$module) {
            $module = $this->ask($input, $output, 'Which module? ', 'SkyHub');
        }
    
        if (!$name) {
            $name = $this->ask($input, $output, 'Model\'s class name? ', 'Preset');
        }

        try {
            $maker = new \Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceModel($name, $module, $vendor);
            
            /** @var PhpClassBuilder $file */
            $builder = $maker->build();
            
            $filesystem = new Filesystem();
            $filesystem->dumpFile($maker->getFilename(), (string) $builder);
            
            $output->writeln('Resource model was created!');
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
