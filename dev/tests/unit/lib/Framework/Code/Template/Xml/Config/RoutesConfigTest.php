<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\Config\Routes as RoutesTemplate;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;

class RoutesConfigTest extends XmlConfigAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:App/etc/routes.xsd';
    
    
    /**
     * @test
     */
    public function defaultRoutesConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <router id="standard">
        <route id="myvendortest_mymoduletest" frontName="myvendortest_mymoduletest">
            <module name="MyVendorTest_MyModuleTest" />
        </route>
    </router>
</config>
XML;
        
        $template = $this->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function adminRoutesConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <router id="admin">
        <route id="myvendortest_mymoduletest" frontName="myvendortest_mymoduletest">
            <module name="MyVendorTest_MyModuleTest" before="Magento_Backend" />
        </route>
    </router>
</config>
XML;
        
        $template = $this->getTemplate('admin', null, null, true);
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function adminRoutesConfigWithDifferentParameters()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <router id="admin">
        <route id="my_id" frontName="front">
            <module name="MyVendorTest_MyModuleTest" before="Magento_Backend" />
        </route>
    </router>
</config>
XML;
        
        $template = $this->getTemplate('admin', 'my_id', 'front', true);
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return RoutesTemplate
     */
    protected function getTemplate(
        string $use = 'standard',
        string $routeId = null,
        string $frontName = null,
        bool $isAdmin = false
    )
    {
        $template = TemplateFactory::buildRoutesTemplate();
        
        $template->build();
        $template->setRouterId($use);
        $template->addRoute($this->getModuleName(), $routeId, $frontName, $isAdmin);
        
        return $template;
    }
}
