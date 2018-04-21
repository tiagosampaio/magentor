<?php

namespace Magentor\Framework\Console\Command;

use Magentor\Framework\Magento\ApplicationInterface;
use Magentor\Framework\Magento\Operation\CommandInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class CommandAbstract extends SymfonyCommand
{

    /** @var string */
    protected $name = null;

    /** @var string */
    protected $description = null;

    /** @var ApplicationInterface */
    private $magentoApplication;


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


    protected function configure()
    {
        if (!empty($this->name)) {
            $this->setName($this->name);
        }

        if (!empty($this->description)) {
            $this->setDescription($this->description);
        }

        parent::configure();
    }
}
