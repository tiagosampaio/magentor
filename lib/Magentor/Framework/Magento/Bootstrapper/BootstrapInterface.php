<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Magento\ApplicationInterface;

interface BootstrapInterface
{
    
    /**
     * @param ApplicationInterface $magento
     *
     * @return mixed
     */
    public function dispatch(ApplicationInterface $magento);


    /**
     * Initializes Magento Application.
     *
     * @return bool
     */
    public function initializeMagento();
}
