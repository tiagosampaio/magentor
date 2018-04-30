<?php

namespace Magentor\Framework\Code\Template\Xml\Config\Acl;

use Magentor\Framework\Code\Template\Xml\XmlElement;

class Resource extends XmlElement
{
    
    /**
     * @param string      $code
     * @param string|null $title
     * @param int         $sortOrder
     *
     * @return Resource
     */
    public function addSubResource(string $code, string $title = null, int $sortOrder = 10)
    {
        /** @var Resource $resource */
        $resource = $this->addChild('resource');
        $resource->prepare($code, $title, $sortOrder);
        
        return $resource;
    }
    
    
    /**
     * @param string      $code
     * @param string|null $title
     * @param int         $sortOrder
     *
     * @return Resource
     */
    public static function newResource(string $code, string $title = null, int $sortOrder = 10)
    {
        /** @var Resource $resource */
        $resource = new Resource('<resource/>');
        $resource->prepare($code, $title, $sortOrder);
    
        return $resource;
    }
    
    
    /**
     * @param string      $code
     * @param string|null $title
     * @param int         $sortOrder
     *
     * @return $this
     */
    public function prepare(string $code, string $title = null, int $sortOrder = 10)
    {
        $this->addAttribute('id', $code);
        $this->addAttribute('title', $title ?: $code);
    
        if ($title) {
            $this->addAttribute('translate', 'title');
        }
    
        $this->addAttribute('sortOrder', (int) $sortOrder);
        
        return $this;
    }
}
