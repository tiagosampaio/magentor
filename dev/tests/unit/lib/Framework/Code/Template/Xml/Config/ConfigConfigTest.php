<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\Config\Config as ConfigTemplate;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;

class ConfigConfigTest extends XmlConfigAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:module:Magento_Store:etc/config.xsd';
    
    
    /**
     * @test
     */
    public function defaultConfigConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <default/>
</config>
XML;
        
        $template = $this->getTemplate();
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function configWithSection()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <default>
        <module/>
    </default>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addSection('module');
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function configWithGroup()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <default>
        <module>
            <my_group/>
        </module>
    </default>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addGroup('module', 'my_group');
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function configWithFields()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <default>
        <module>
            <my_group>
                <field_one>1</field_one>
                <field_two>2</field_two>
            </my_group>
        </module>
    </default>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addField('module', 'my_group', 'field_one', 1);
        $template->addField('module', 'my_group', 'field_two', 2);
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return ConfigTemplate
     */
    protected function getTemplate()
    {
        $template = TemplateFactory::buildConfigTemplate();
        $template->build();
        
        return $template;
    }
}
