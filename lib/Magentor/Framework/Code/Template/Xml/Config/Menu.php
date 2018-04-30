<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\ConfigElement;

class Menu extends ConfigElement
{
    
    /**
     * @return bool|\Magentor\Framework\SimpleXML\Element
     */
    public function menu()
    {
        $this->initialize();
        return $this->node('menu');
    }
    
    
    /**
     * @param string $module
     *
     * @return $this
     */
    public function addMenu(
        string $module,
        string $id,
        string $title,
        string $resource = null,
        int $sortOrder = 10,
        string $parent = null)
    {
        if (empty($module)) {
            return $this;
        }
        
        /** @var ConfigElement $menu */
        $menu = $this->menu()->addChild('add');
        $menu->addAttribute('id', "{$module}::{$id}");
        $menu->addAttribute('title', $title);
        $menu->addAttribute('translate', 'title');
        $menu->addAttribute('sortOrder', $sortOrder);
        
        if ($resource) {
            $menu->addAttribute('resource', $resource);
        }
        
        if ($parent) {
            $menu->addAttribute('parent', $parent);
        }
        
        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        if (false === $this->node('menu')) {
            $this->addChild('menu');
        }
        
        return $this;
    }
}
