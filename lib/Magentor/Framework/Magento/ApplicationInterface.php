<?php

namespace Magentor\Framework\Magento;

use Magentor\Framework\Magento\Bootstrapper\BootstrapperInterface;

interface ApplicationInterface
{
    
    /**
     * @return $this
     */
    public function bootstrap();
    
    
    /**
     * @return $this
     */
    public function setBootstrapper(BootstrapperInterface $bootstrapper);
    
    
    /**
     * @return BootstrapperInterface
     */
    public function getBootstrapper();
    
    
    /**
     * @return ApplicationInterface
     */
    public static function getInstance();
    
}
