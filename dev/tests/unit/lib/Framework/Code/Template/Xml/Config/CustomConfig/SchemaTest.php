<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config\Custom;

use Magentor\Framework\Code\Template\Xml\Config\CustomConfig\Schema;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;
use MagentorTest\Framework\Code\Template\Xml\Config\XmlConfigAbstract;

class SchemaTest extends XmlConfigAbstract
{
    
    
    /**
     * @test
     */
    public function defaultModuleConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
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
        
        $template = $this->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return Schema
     */
    protected function getTemplate()
    {
        $template = TemplateFactory::buildCustomSchemaTemplate();
        $template->build();
        
        return $template;
    }
}
