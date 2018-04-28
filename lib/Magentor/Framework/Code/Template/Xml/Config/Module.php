<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\XmlAbstract;
use Magentor\Framework\Code\Template\Xml\XmlElement;

class Module extends XmlAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:Module/etc/module.xsd';
    
    /** @var string */
    protected $setupVersion = '0.1.0';
    
    /** @var XmlElement */
    protected $moduleXml = null;
    
    /** @var XmlElement */
    protected $sequenceXml = null;
    
    /** @var array */
    protected $sequencesCache = [];
    
    
    /**
     * Module constructor.
     *
     * @param string      $module
     * @param string      $vendor
     * @param string|null $setupVersion
     */
    public function __construct(string $module, string $vendor, string $setupVersion = null)
    {
        parent::__construct($module, $vendor);
        
        if (!empty($setupVersion)) {
            $this->setupVersion = $setupVersion;
        }
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
        
        if (isset($this->sequencesCache[$module])) {
            return $this;
        }
        
        if (!$this->sequenceXml) {
            $this->sequenceXml = $this->moduleXml->addChild('sequence');
        }
    
        $this->sequenceXml->addChild($module);
        $this->sequencesCache[$module] = true;
        
        return $this;
    }
    
    
    /**
     * @param XmlElement $xml
     *
     * @return $this
     */
    protected function prepare(XmlElement $xml)
    {
        if (is_null($this->moduleXml)) {
            $this->moduleXml = $xml->addChild('module');
            $this->moduleXml->addAttribute('name', $this->getModuleName());
            $this->moduleXml->addAttribute('setup_version', $this->setupVersion);
        }
        
        return $this;
    }
}
