<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\XmlAbstract;
use Magentor\Framework\Code\Template\Xml\XmlElement;

class Routes extends XmlAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:App/etc/routes.xsd';
    
    /** @var XmlElement */
    protected $routerXml = null;
    
    /** @var bool */
    protected $isAdmin = false;
    
    /** @var string */
    protected $id = null;
    
    /** @var string */
    protected $frontName = null;
    
    /** @var array */
    protected $sections = [];
    
    /** @var array */
    protected $groups = [];
    
    
    /**
     * Module constructor.
     *
     * @param string $module
     * @param string $vendor
     */
    public function __construct(
        string $module,
        string $vendor,
        string $id = null,
        string $frontName = null,
        bool $isAdmin = false
    )
    {
        parent::__construct($module, $vendor);
        
        $this->isAdmin = (bool) $isAdmin;
        $this->id = $id;
        $this->frontName = $frontName;
    }
    
    
    /**
     * @return bool
     */
    public function isAdmin()
    {
        return true === $this->isAdmin;
    }
    
    
    /**
     * @return string
     */
    public function getRouterId() : string
    {
        return $this->isAdmin() ? 'admin' : 'standard';
    }
    
    
    /**
     * @return string
     */
    public function getRouteId() : string
    {
        if (!empty($this->id)) {
            return $this->id;
        }
        
        return strtolower($this->getModuleName());
    }
    
    
    /**
     * @return string
     */
    public function getFrontName() : string
    {
        if (!empty($this->frontName)) {
            return $this->frontName;
        }
        
        return strtolower($this->getModuleName());
    }
    
    
    /**
     * @param XmlElement $xml
     *
     * @return $this
     */
    protected function prepare()
    {
        if (is_null($this->routerXml)) {
            $this->routerXml = $this->getXml()->addChild('router');
            $this->routerXml->addAttribute('id', $this->getRouterId());
    
            $route = $this->routerXml->addChild('route');
            $route->addAttribute('id', $this->getRouteId());
            $route->addAttribute('frontName', $this->getFrontName());
            
            $module = $route->addChild('module');
            $module->addAttribute('name', $this->getModuleName());
            
            if ($this->isAdmin()) {
                $module->addAttribute('before', 'Magento_Backend');
            }
        }
        
        return $this;
    }
}
