<?php

namespace Magentor\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\Config\Acl\Resource;
use Magentor\Framework\Code\Template\Xml\ConfigElement;

class Acl extends ConfigElement
{
    
    /**
     * @param string      $code
     * @param string|null $title
     * @param int         $sortOrder
     *
     * @return ConfigElement
     */
    public function addResource(string $code, string $title = null, int $sortOrder = 10)
    {
        $this->initialize();
        
        /** @var ConfigElement $resource */
        $resource = $this->resources()->addChild('resource');
        $resource->addAttribute('id', $code);
        
        if ($title) {
            $resource->addAttribute('title', $title);
            $resource->addAttribute('translate', 'title');
        }
        
        $resource->addAttribute('sortOrder', $sortOrder);
        
        return $resource;
    }
    
    
    /**
     * @param Resource $resource
     *
     * @return $this
     */
    public function appendResource(Resource $resource)
    {
        $this->resources()->append($resource);
        return $this;
    }
    
    
    /**
     * @return ConfigElement
     */
    protected function acl()
    {
        $this->initialize();
        
        /** @var ConfigElement $acl */
        $acl = $this->node('acl');
    
        return $acl;
    }
    
    
    /**
     * @return bool|\Magentor\Framework\SimpleXML\Element
     */
    protected function resources()
    {
        return $this->acl()->node('resources');
    }
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        if (false === $this->node('acl')) {
            $acl = $this->addChild('acl');
            $acl->addChild('resources');
        }
        
        return $this;
    }
}
