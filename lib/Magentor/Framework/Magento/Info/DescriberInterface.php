<?php

namespace Magentor\Framework\Magento\Info;

interface DescriberInterface
{
    
    
    /**
     * @return bool
     */
    public function isMagentoOne();
    
    
    /**
     * @return bool
     */
    public function isMagentoTwo(string $directory = null);
}
