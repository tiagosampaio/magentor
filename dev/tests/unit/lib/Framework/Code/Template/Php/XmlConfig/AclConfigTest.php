<?php

namespace MagentorTest\Framework\Code\Template\Php\XmlConfig;

use Magentor\Framework\Code\Template\Xml\Config\Acl as AclTemplate;

class AclConfigTest extends XmlConfigAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:acl/etc/acl.xsd';
    
    
    /**
     * @test
     */
    public function defaultAclConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <acl>
        <resources/>
    </acl>
</config>
XML;
        
        $template = $this->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
    }
    
    
    /**
     * @test
     */
    public function aclConfigWithOneResource()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <acl>
        <resources>
            <resource id="{$this->getModuleName()}::test" title="Test" translate="title" sortOrder="10"/>
        </resources>
    </acl>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addResource('test', 'Test');
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
    }
    
    
    /**
     * @test
     */
    public function aclConfigWithTwoResource()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <acl>
        <resources>
            <resource id="{$this->getModuleName()}::test" title="Test" translate="title" sortOrder="10"/>
            <resource id="{$this->getModuleName()}::myTest" title="My Test" translate="title" sortOrder="90"/>
        </resources>
    </acl>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addResource('test', 'Test');
        $template->addResource('myTest', 'My Test', 90);
        
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
    }
    
    
    /**
     * @param array $resources
     *
     * @return AclTemplate
     */
    protected function getTemplate(array $resources = [])
    {
        return new AclTemplate($this->module, $this->vendor, $resources);
    }
}
