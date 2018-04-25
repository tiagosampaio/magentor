<?php

namespace Magentor\Maker\Commands;

use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MakeModel extends CommandAbstract
{

    protected function configure()
    {
        $this->setName('make:model')
            ->setDescription('Creates a Magento model.');

//        $this->addArgument('vendor', InputArgument::REQUIRED, 'The module\'s vendor name', null);
//        $this->addArgument('module', InputArgument::REQUIRED, 'The module\'s name.', null);

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
        $vendor = $this->ask($input, $output, 'Which vendor? ', 'BitTools');
        $module = $this->ask($input, $output, 'Which module? ', 'SkyHub');
        $class  = $this->ask($input, $output, 'Model\'s class name? ', 'Preset');

        try {
            $maker = new \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model($class, $module, $vendor);
            $maker->generate();
    
            $output->writeln('Model was created!');
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