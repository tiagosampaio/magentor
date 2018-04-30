<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config;

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
        
        $template = $this->getTemplate('standard');
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @ test
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
     * @ test
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
        $module = $this->vendor . '_' . $this->module;
        
        $template = new RoutesTemplate('<config/>', LIBXML_NOERROR, false, 'ws', true);
        $template->setXsiUrl($this->xsiUrl)
                 ->setSchemaLocation($this->schemaLocation);
        
        $template->setRouterId($id);
        $template->addRoute($module, $module, $frontName, $isAdmin);
        
        return $template;
    }
}
