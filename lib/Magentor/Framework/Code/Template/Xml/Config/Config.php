<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\XmlAbstract;
use Magentor\Framework\Code\Template\Xml\XmlElement;

class Config extends XmlAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:module:Magento_Store:etc/config.xsd';
    
    /** @var XmlElement */
    protected $defaultXml = null;
    
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
    public function __construct(string $module, string $vendor)
    {
        parent::__construct($module, $vendor);
    }
    
    
    /**
     * @param $name
     *
     * @return XmlElement
     */
    public function addSection($name)
    {
        $this->prepare();
        
        $this->sections[$name] = $this->defaultXml->addChild($name);
        return $this->sections[$name];
    }
    
    
    /**
     * @param $name
     *
     * @return XmlElement
     */
    public function getSection($name)
    {
        $this->prepare();
        
        if (isset($this->sections[$name])) {
            return $this->sections[$name];
        }
        
        return $this->addSection($name);
    }
    
    
    /**
     * @param string $sectionName
     * @param string $groupName
     *
     * @return XmlElement
     */
    public function addGroup(string $sectionName, string $groupName)
    {
        /** @var XmlElement $section */
        $section = $this->getSection($sectionName);
        
        /** @var XmlElement $group */
        $group = $section->addChild($groupName);
        
        $this->groups[$sectionName . '/' . $groupName] = $group;
        
        return $group;
    }
    
    
    /**
     * @param string $sectionName
     * @param string $groupName
     *
     * @return XmlElement
     */
    public function getGroup(string $sectionName, string $groupName)
    {
        $group = $sectionName . '/' . $groupName;
        
        if (isset($this->groups[$group])) {
            return $this->groups[$group];
        }
        
        return $this->addGroup($sectionName, $groupName);
    }
    
    
    /**
     * @param string      $sectionName
     * @param string      $groupName
     * @param string      $fieldName
     * @param string|null $value
     *
     * @return $this
     */
    public function addField(string $sectionName, string $groupName, string $fieldName, string $value = null)
    {
        $group = $this->getGroup($sectionName, $groupName);
        $group->addChild($fieldName, $value);
        
        return $this;
    }
    
    
    /**
     * @param XmlElement $xml
     *
     * @return $this
     */
    protected function prepare()
    {
        if (is_null($this->defaultXml)) {
            $this->defaultXml = $this->getXml()->addChild('default');
        }
        
        return $this;
    }
}
