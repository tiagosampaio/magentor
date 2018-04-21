<?php

namespace Magentor\Framework\Magento;

use Magentor\Framework\Magento\Bootstrapper\BootstrapperInterface;

class Application implements ApplicationInterface
{
    
    const MAGENTO_ONE = 1;
    const MAGENTO_TWO = 1;
    
    /** @var Info\DescriberInterface */
    protected $describer;
    
    /** @var BootstrapperInterface */
    protected $bootstrapper;
    
    /** @var Application */
    protected static $instance;
    
    
    /**
     * Application constructor.
     *
     * Keep unique instance of this.
     */
    protected function __construct()
    {}
    
    
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
        /** @var BootstrapperInterface $bootstrapper */
        if ($this->getDescriber()->isMagentoOne()) {
            $class = \Magentor\Framework\Magento\Bootstrapper\MagentoOne::class;
        }
        
        if ($this->getDescriber()->isMagentoTwo()) {
            $class = \Magentor\Framework\Magento\Bootstrapper\MagentoTwo::class;
        }
    
        $bootstrapper = new $class();
        $bootstrapper->dispatch($this);
        
        return $this;
    }
    
    
    /**
     * @param BootstrapperInterface $bootstrapper
     *
     * @return $this
     */
    public function setBootstrapper(BootstrapperInterface $bootstrapper)
    {
        $this->bootstrapper = $bootstrapper;
        return $this;
    }
    
    
    /**
     * @return BootstrapperInterface
     */
    public function getBootstrapper()
    {
        return $this->bootstrapper;
    }
    
    
    /**
     * @return Info\DescriberInterface
     */
    protected function getDescriber()
    {
        if (empty($this->describer)) {
            $this->describer = new Info\Describer($this);
        }
        
        return $this->describer;
    }
}
