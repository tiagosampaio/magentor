<?php

namespace Magentor\Framework\Code\Template\Xml;

use Magentor\Framework\SimpleXML\Element;

abstract class ConfigElement extends Element implements XmlInterface
{
    
    /**
     * @return $this
     */
    abstract protected function initialize();
    
    
    /**
     * @param string $xsiUrl
     *
     * @return $this
     */
    public function setXsiUrl(string $xsiUrl = 'http://www.w3.org/2001/XMLSchema-instance')
    {
        $this->addAttribute('xmlns:xmlns:xsi', $xsiUrl);
        return $this;
    }
    
    
    /**
     * @param string $schemaLocation
     *
     * @return $this
     */
    public function setSchemaLocation(string $schemaLocation)
    {
        $this->addAttribute('xmlns:xsi:noNamespaceSchemaLocation', $schemaLocation);
        return $this;
    }
    
    
    /**
     * @return mixed
     */
    public function build()
    {
        $this->initialize();
        return $this;
    }
    
    
    /**
     * @param string|null $filename
     *
     * @return mixed
     */
    public function toXml(bool $beauty = true)
    {
        $this->build();
        
        $xmlString = $this->asXML();
        
        if (!$beauty) {
            return $xmlString;
        }
        
        $dom = new \DOMDocument("1.0");
        
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput       = true;
        
        $dom->loadXML($xmlString);
        
        return $dom->saveXML();
    }
}
