<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Magento\ApplicationInterface;

interface BootstrapperInterface
{
    
    /**
     * @param ApplicationInterface $magento
     *
     * @return mixed
     */
    public function dispatch(ApplicationInterface $magento);
    
    
    /**
     * @return string
     */
    public function getVersion();
}