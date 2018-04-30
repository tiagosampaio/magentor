<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\ConfigElement;

class Module extends ConfigElement
{
    
    /**
     * @return bool|\Magentor\Framework\SimpleXML\Element
     */
    public function module()
    {
        $this->initialize();
        return $this->node('module');
    }
    
    
    /**
     * @return bool|\Magentor\Framework\SimpleXML\Element|\SimpleXMLElement
     */
    public function getSequence()
    {
        $sequence = $this->module()->node('sequence');
        
        if (false === $sequence) {
            $sequence = $this->module()->addChild('sequence');
        }
        
        return $sequence;
    }
    
    
    /**
     * @param string $module
     *
     * @return $this
     */
    public function addSequence(string $module = null)
    {
        if (empty($module)) {
            return $this;
        }
        
        $this->getSequence()->addChild($module);
        
        return $this;
    }
    
    
    /**
     * @param string $name
     *
     * @return $this
     */
    public function setModuleName(string $name)
    {
        $this->node('module')->addAttribute('name', $name);
        return $this;
    }
    
    
    /**
     * @param string $setupVersion
     *
     * @return $this
     */
    public function setSetupVersion(string $setupVersion = null)
    {
        $this->node('module')->addAttribute('setup_version', $setupVersion);
        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        if (false === $this->node('module')) {
            $this->addChild('module');
        }
        
        return $this;
    }
}
