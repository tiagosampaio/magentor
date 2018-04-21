<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Magento\ApplicationInterface;

abstract class BootstrapperAbstract implements BootstrapperInterface
{
    
    /** @var ApplicationInterface */
    protected $magentoApplication;
    
    
    /**
     * @param ApplicationInterface $magentoApplication
     *
     * @return $this|mixed
     */
    public function dispatch(ApplicationInterface $magentoApplication)
    {
        $this->magentoApplication = $magentoApplication;
        $magentoApplication->setBootstrapper($this);
        
        $this->prepare();
        
        return $this;
    }
    
    
    abstract protected function prepare();
}
