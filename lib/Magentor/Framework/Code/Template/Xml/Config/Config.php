<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\ConfigElement;

class Config extends ConfigElement
{
    /** @var array */
    protected $sections = [];
    
    /** @var array */
    protected $groups = [];
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        if (false === $this->node('default')) {
            $this->addChild('default');
        }
        
        return $this;
    }
    
    
    /**
     * @param $name
     *
     * @return ConfigElement
     */
    public function addSection($name)
    {
        $this->initialize();
        
        /** @var ConfigElement $section */
        $section = $this->node('default')->addChild($name);
        
        return $section;
    }
    
    
    /**
     * @param $name
     *
     * @return ConfigElement
     */
    public function getSection($name)
    {
        $section = $this->node('default')->node($name);
        
        if (false === $section) {
            $section = $this->addSection($name);
        }
        
        return $section;
    }
    
    
    /**
     * @param string $sectionName
     * @param string $groupName
     *
     * @return ConfigElement
     */
    public function addGroup(string $sectionName, string $groupName)
    {
        /** @var ConfigElement $section */
        $section = $this->getSection($sectionName);
        
        /** @var ConfigElement $group */
        $group = $section->addChild($groupName);
        
        return $group;
    }
    
    
    /**
     * @param string $sectionName
     * @param string $groupName
     *
     * @return ConfigElement
     */
    public function getGroup(string $sectionName, string $groupName)
    {
        /** @var ConfigElement $group */
        $group = $this->getSection($sectionName)->node($groupName);
        
        if (false === $group) {
            $group = $this->getSection($sectionName)->addChild($groupName);
        }
        
        return $group;
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
        $this->getGroup($sectionName, $groupName)->addChild($fieldName, $value);
        return $this;
    }
}
