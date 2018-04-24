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
        $vendor    = $this->ask($input, $output, 'Which vendor? ', 'BitTools');
        $module    = $this->ask($input, $output, 'Which module? ', 'SkyHub');
        $modelFile = $this->ask($input, $output, 'Model\'s name? ', 'Preset');

        $moduleDir = DirectoryRegistrar::magentoBuildPath("app/code/{$vendor}/{$module}");
        $dirMode   = 0755;
        
        if (!is_dir($moduleDir)) {
            $created = mkdir($moduleDir, $dirMode, true);
        }
        
        $modelDir = $moduleDir . DIRECTORY_SEPARATOR . 'Model';
        if (!is_dir($modelDir)) {
            $created = mkdir($modelDir, $dirMode, true);
        }
        
        $modelFilepath = $modelDir . DIRECTORY_SEPARATOR . $modelFile . '.php';
        if (file_exists($modelFilepath)) {
            $output->writeln('Model already exists. Cannot create it.');
            return;
        }
        
        $name      = $modelFile;
        
        $phpFile = new \Nette\PhpGenerator\PhpFile();
        $abstractModel = "\Magento\Framework\Model\AbstractModel";
        
        $namespace = $vendor . '\\' . $module . '\\' . 'Model';
        $namespace = $phpFile->addNamespace($namespace);
        $namespace->addUse($abstractModel);
        
        /** @var \Nette\PhpGenerator\ClassType $class */
        $class = $namespace->addClass($name);
        $class->addExtend($abstractModel);
        
        $io = @file_put_contents($modelFilepath, (string) $phpFile);
        
        $output->writeln((string) $phpFile);
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
