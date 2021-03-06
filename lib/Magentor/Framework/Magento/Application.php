<?php

namespace Magentor\Framework\Magento;

use Magentor\Framework\Exception\ExceptionContainer;

class Application implements ApplicationInterface
{
    
    const MAGENTO_ONE = 1;
    const MAGENTO_TWO = 2;

    /** @var Bootstrapper\BootstrapInterface */
    protected $bootstrapper;

    /** @var Info\Version\InfoInterface */
    protected $info;

    /** @var Operation\CommandInterface */
    protected $operationCommand;
    
    /** @var Application */
    protected static $instance;
    
    
    /**
     * Application constructor.
     *
     * Keep unique instance of this.
     */
    protected function __construct()
    {
    }
    
    
    /**
     * @return Application
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    
    /**
     * @return $this
     */
    public function bootstrap()
    {
        /** @var Info\Version\InfoInterface $info */
        $this->info = (new Info\Builder())->build($this);
        
        /** @var Bootstrapper\BootstrapInterface $bootstrap */
        $this->bootstrapper = new Bootstrapper\Bootstrap();
        $this->bootstrapper->dispatch($this);
        
        return $this;
    }
    
    
    /**
     * @param Bootstrapper\BootstrapInterface $bootstrapper
     *
     * @return $this
     */
    public function setBootstrapper(Bootstrapper\BootstrapInterface $bootstrapper)
    {
        $this->bootstrapper = $bootstrapper;
        return $this;
    }
    
    
    /**
     * @return Bootstrapper\BootstrapInterface
     */
    public function getBootstrapper()
    {
        return $this->bootstrapper;
    }


    /**
     * @return Info\Version\InfoInterface
     */
    public function getInfo()
    {
        return $this->info;
    }


    /**
     * @return ExceptionContainer
     */
    public function exceptionContainer()
    {
        return ExceptionContainer::getInstance();
    }
}
