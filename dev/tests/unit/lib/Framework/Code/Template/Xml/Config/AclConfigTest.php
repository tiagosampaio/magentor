<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\Config\Acl as AclTemplate;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;

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
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
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
        $template->addResource("{$this->getModuleName()}::test", 'Test');
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
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
        $template->addResource("{$this->getModuleName()}::test", 'Test');
        $template->addResource("{$this->getModuleName()}::mytest", 'My Test', 90);
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function aclConfigWithNestedResource()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <acl>
        <resources>
            <resource id="{$this->getModuleName()}::test" title="Test" translate="title" sortOrder="10">
                <resource id="{$this->getModuleName()}::subTest" title="Sub Test" translate="title" sortOrder="10">
                    <resource id="{$this->getModuleName()}::subSubTest" title="Sub Sub Test" translate="title" sortOrder="10"/>
                </resource>
            </resource>
            <resource id="{$this->getModuleName()}::secondTest" title="Second Test" translate="title" sortOrder="20"/>
        </resources>
    </acl>
</config>
XML;
        
        $template    = $this->getTemplate();
        $resource    = AclTemplate\Resource::newResource('MyVendorTest_MyModuleTest::test', 'Test');
        $resource->addSubResource('MyVendorTest_MyModuleTest::subTest', 'Sub Test')
                 ->addSubResource('MyVendorTest_MyModuleTest::subSubTest', 'Sub Sub Test');
    
        $template->appendResource($resource);
        $template->addResource("{$this->getModuleName()}::secondTest", 'Second Test', 20);
    
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @param array $resources
     *
     * @return AclTemplate
     */
    protected function getTemplate()
    {
        $template = TemplateFactory::buildAclTemplate();
        $template->build();
    
        return $template;
    }
}
