<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\XmlAbstract;
use SimpleXMLElement;

class Module extends XmlAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:Module/etc/module.xsd';
    
    /** @var string */
    protected $setupVersion = '0.1.0';
    
    /** @var SimpleXMLElement */
    protected $moduleXml = null;
    
    /** @var SimpleXMLElement */
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
    public function addSequence(string $module)
    {
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
     * @param SimpleXMLElement $xml
     *
     * @return $this
     */
    protected function prepare(SimpleXMLElement $xml)
    {
        if (is_null($this->moduleXml)) {
            $this->moduleXml = $xml->addChild('module');
            $this->moduleXml->addAttribute('name', $this->getModuleName());
            $this->moduleXml->addAttribute('setup_version', $this->setupVersion);
        }
        
        return $this;
    }
}
