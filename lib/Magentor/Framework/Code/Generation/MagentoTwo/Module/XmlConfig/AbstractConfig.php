<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig;

use Magentor\Framework\Code\Template\Xml\XmlAbstract;

abstract class AbstractConfig
{
    
    /** @var string */
    protected $module;
    
    /** @var string */
    protected $vendor;
    
    /** @var XmlAbstract */
    protected $template;
    
    
    /**
     * AbstractConfig constructor.
     *
     * @param string $module
     * @param string $vendor
     */
    public function __construct(string $module, string $vendor)
    {
        $this->module = $module;
        $this->vendor = $vendor;
    }
    
    
    /***
     * @return XmlAbstract
     */
    public function getTemplate()
    {
        $this->initTemplate();
        return $this->template;
    }
    
    
    /**
     * @return XmlAbstract
     */
    public function build()
    {
        /** @var XmlAbstract $template */
        $template = $this->getTemplate();
        $template->build();
        
        $this->postBuild();
        
        return $template;
    }
    
    
    /**
     * @return void
     */
    abstract protected function postBuild();
    
    
    /**
     * @return $this
     */
    protected function initTemplate()
    {
        if (is_null($this->template)) {
            $this->template = $this->getTemplateInstance();
        }
        
        return $this;
    }
    
    
    /**
     * @return XmlAbstract
     */
    abstract protected function getTemplateInstance();
}