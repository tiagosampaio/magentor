<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Magento\ApplicationInterface;

abstract class BootstrapAbstract implements BootstrapInterface
{
    
    /** @var ApplicationInterface */
    protected $magento;
    
    
    /**
     * @inheritdoc
     */
    public function dispatch(ApplicationInterface $magento)
    {
        $this->magento = $magento;
        $this->prepare();
        
        return $this;
    }
    
    
    abstract protected function prepare();
}
