<?php

namespace MagentorTest\Framework\Code\Template\Php\XmlConfig;

use Magentor\Framework\Code\Template\Xml\Config\Routes as RoutesTemplate;

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
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        
        $template = $this->getTemplate(null, null, true);
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        
        $template = $this->getTemplate('my_id', 'front', true);
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return RoutesTemplate
     */
    protected function getTemplate(string $id = null, string $frontName = null, bool $isAdmin = false)
    {
        return new RoutesTemplate($this->module, $this->vendor, $id, $frontName, $isAdmin);
    }
}
