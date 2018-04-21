<?php

namespace Magentor\ModuleCreator\Commands;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateModule extends CommandAbstract
{

    protected $name = 'module:create';


    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $helper */
        $helper   = $this->getHelper('question');

        



        $question = new Question('Who are you? ');

        $name     = $helper->ask($input, $output, $question);

        $output->writeln("Great, {$name}!");
    }
}
