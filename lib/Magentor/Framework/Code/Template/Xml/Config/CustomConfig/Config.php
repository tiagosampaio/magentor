<?php

namespace Magentor\Framework\Code\Template\Xml\Config\CustomConfig;

use Magentor\Framework\Code\Template\Xml\ConfigElement;

class Config extends ConfigElement
{
    
    /**
     * @return bool|\Magentor\Framework\SimpleXML\Element
     */
    public function productAttributes()
    {
        $this->initialize();
        return $this->node('product_attributes');
    }
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        if (false === $this->node('custom_config')) {
            $this->addChild('custom_config');
        }
        
        return $this;
    }
}
