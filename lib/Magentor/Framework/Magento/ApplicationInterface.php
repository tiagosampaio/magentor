<?php

namespace Magentor\Framework\Magento;

use Magentor\Framework\Magento\Info\Version\InfoInterface;

interface ApplicationInterface
{
    
    /**
     * @return $this
     */
    public function bootstrap();


    /**
     * @param Bootstrapper\BootstrapInterface $bootstrapper
     *
     * @return $this
     */
    public function setBootstrapper(Bootstrapper\BootstrapInterface $bootstrapper);
    
    
    /**
     * @return Bootstrapper\BootstrapInterface
     */
    public function getBootstrapper();


    /**
     * @return InfoInterface
     */
    public function getInfo();
    
    
    /**
     * @return ApplicationInterface
     */
    public static function getInstance();
}
