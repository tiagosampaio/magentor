<?php

namespace MagentorTest\Framework\Code\Template\Php\XmlConfig;

use Magentor\Framework\Code\Template\Xml\Config\Config as ConfigTemplate;

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
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return ConfigTemplate
     */
    protected function getTemplate()
    {
        return new ConfigTemplate($this->module, $this->vendor);
    }
}
