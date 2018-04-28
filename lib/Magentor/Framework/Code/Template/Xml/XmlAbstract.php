<?php

namespace Magentor\Framework\Code\Template\Xml;

abstract class XmlAbstract implements XmlInterface
{
    
    /** @var XmlElement */
    protected $xml;
    
    /** @var string */
    protected $rootNode = "<config/>";
    
    /** @var string */
    protected $xsiUrl = 'http://www.w3.org/2001/XMLSchema-instance';
    
    /** @var string */
    protected $schemaLocation;
    
    /** @var string */
    protected $module;
    
    /** @var string */
    protected $vendor;
    
    
    /**
     * XmlAbstract constructor.
     *
     * @param string $module
     * @param string $vendor
     */
    public function __construct(string $module, string $vendor)
    {
        $this->module = $module;
        $this->vendor = $vendor;
    }
    
    
    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->vendor . '_' . $this->module;
    }
    
    
    /**
     * @param XmlElement|null $xml
     *
     * @return $this
     */
    public function build(XmlElement $xml = null)
    {
        $this->initXml($xml);
        $this->prepare($this->getXml());
        
        return $this;
    }
    
    
    /**
     * @return XmlElement
     */
    public function getXml()
    {
        $this->initXml();
        return $this->xml;
    }
    
    
    /**
     * @param string|null $filename
     *
     * @return mixed
     */
    public function toXml(string $filename = null, bool $beauty = true)
    {
        $xmlString = $this->getXml()->asXML();
        
        if (!$beauty) {
            return $xmlString;
        }
        
        $dom = new \DOMDocument("1.0");
        
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput       = true;
        
        $dom->loadXML($xmlString);
        
        return $dom->saveXML();
    }
    
    
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->toXml();
    }
    
    
    
    abstract protected function prepare(XmlElement $xml);
    
    
    /**
     * @param XmlElement|null $xml
     *
     * @return $this
     */
    protected function initXml(XmlElement $xml = null)
    {
        if (!is_null($this->xml)) {
            return $this;
        }
        
        if (is_null($xml)) {
            $this->xml = new XmlElement($this->rootNode, LIBXML_NOERROR, false, 'ws', true);
        }
        
        $this->xml->addAttribute('xmlns:xmlns:xsi', $this->xsiUrl);
        $this->xml->addAttribute('xmlns:xsi:noNamespaceSchemaLocation', $this->schemaLocation);
        
        return $this;
    }
}
