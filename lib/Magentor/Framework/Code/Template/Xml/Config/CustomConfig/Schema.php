<?php

namespace Magentor\Framework\Code\Template\Xml\Config\CustomConfig;

class Schema
{
    
    /** @var string */
    protected $xsUrl = 'http://www.w3.org/2001/XMLSchema';
    
    
    /**
     * @param string $xsUrl
     *
     * @return $this
     */
    public function setXsUrl(string $xsUrl = 'http://www.w3.org/2001/XMLSchema')
    {
        $this->xsUrl = $xsUrl;
        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function initialize()
    {
        return $this;
    }
    
    
    /**
     * @return $this
     */
    public function build()
    {
        return $this;
    }
    
    
    /**
     * @param bool $beauty
     *
     * @return string
     */
    public function toXml(bool $beauty = true)
    {
        $content = <<<XML
<?xml version="1.0"?>
<xs:schema xmlns:xs="{$this->xsUrl}">
    <xs:element name="config">
        <xs:complexType>
            <xs:sequence>
                <xs:element minOccurs="1" maxOccurs="unbounded" name="custom_config" type="customConfig" />
            </xs:sequence>
        </xs:complexType>
    </xs:element>
    <xs:complexType name="customConfig"/>
</xs:schema>
XML;
        
        return $content;
    }
}
