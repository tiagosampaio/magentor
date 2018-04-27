<?php

namespace Magentor\Framework\Console\Command;

use Magentor\Framework\Magento\ApplicationInterface;
use Magentor\Framework\Magento\Operation\CommandInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

abstract class CommandAbstract extends SymfonyCommand
{

    /** @var string */
    protected $name = null;

    /** @var string */
    protected $description = null;

    /** @var ApplicationInterface */
    private $magentoApplication;
    
    /** @var InputInterface */
    private $input;
    
    /** @var OutputInterface */
    private $output;


    /**
     * Command constructor.
     * @param ApplicationInterface $magentoApplication
     * @param string|null          $name
     */
    public function __construct(ApplicationInterface $magentoApplication, $name = null)
    {
        $this->magentoApplication = $magentoApplication;
        parent::__construct($name);
    }


    /**
     * @return CommandInterface
     */
    abstract protected function magentoCommand();


    /**
     * @return ApplicationInterface
     */
    protected function magento()
    {
        return $this->magentoApplication;
    }
    
    
    /**
     * @return InputInterface
     */
    protected function input()
    {
        return $this->input;
    }
    
    
    /**
     * @return OutputInterface
     */
    protected function output()
    {
        return $this->output;
    }
    
    
    /**
     * @param string $name
     *
     * @return mixed
     */
    protected function getArgument(string $name)
    {
        return $this->input()->getArgument($name);
    }
    
    
    /**
     * Initializes the command just after the input has been validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;
    
        parent::initialize($input, $output);
    }
    
    
    protected function configure()
    {
        if (!empty($this->name)) {
            $this->setName($this->name);
        }

        if (!empty($this->description)) {
            $this->setDescription($this->description);
        }
    
        /**
         * Add the arguments.
         *
         * @var string $name
         * @var array  $arg
         */
        foreach ((array) $this->getArguments() as $name => $arg) {
            if (empty($name)) {
                continue;
            }
            
            $mode        = isset($arg['mode'])        ? $arg['mode']        : InputArgument::OPTIONAL;
            $description = isset($arg['description']) ? $arg['description'] : "One more great command argument!";
            $default     = isset($arg['default'])     ? $arg['default']     : null;
            
            $this->addArgument($name, $mode, $description, $default);
        }
    
        /**
         * Add the options.
         *
         * @var string $name
         * @var array  $opt
         */
        foreach ((array) $this->getOptions() as $name => $opt) {
            if (empty($name)) {
                continue;
            }
            
            $shortcut    = isset($opt['shortcut'])    ? $opt['shortcut']    : null;
            $mode        = isset($opt['mode'])        ? $opt['mode']        : null;
            $description = isset($opt['description']) ? $opt['description'] : "One more great command option!";
            $default     = isset($opt['default'])     ? $opt['default']     : null;
            
            $this->addOption($name, $shortcut, $mode, $description, $default);
        }

        parent::configure();
    }
    
    
    /**
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
    
    
    /**
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
    
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @param string          $message
     * @param string|null     $default
     *
     * @return mixed
     */
    protected function ask(InputInterface $input, OutputInterface $output, string $message, $default = null)
    {
        $question = new Question($message, $default);
        
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $answer = $helper->ask($input, $output, $question);
        
        return $answer;
    }
}
