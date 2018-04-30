<?php

namespace MagentorTest\Framework\Code\Template\Php\XmlConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\ModuleConfig;

class ModuleConfigTest extends XmlConfigAbstract
{
    
    /**
     * @test
     */
    public function defaultModuleConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <module name="{$this->getModuleName()}" setup_version="0.1.0"/>
</config>
XML;
        
        $builder = $this->getBuilder();
        $data    = (string) $builder->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, $data);
    }
    
    
    /**
     * @test
     */
    public function moduleConfigWithDifferentSetupVersion()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <module name="{$this->getModuleName()}" setup_version="3.2.1"/>
</config>
XML;
        
        $builder = $this->getBuilder('3.2.1');
        $data    = (string) $builder->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, $data);
    }
    
    
    /**
     * @test
     */
    public function moduleConfigWithSequences()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <module name="{$this->getModuleName()}" setup_version="3.2.1">
        <sequence>
            <Magento_Catalog/>
            <Magento_Backend/>
            <Magento_Quote/>
        </sequence>
    </module>
</config>
XML;
        
        $builder = $this->getBuilder('3.2.1', ['Magento_Catalog', 'Magento_Backend', 'Magento_Quote']);
        $data    = (string) $builder->build();
        $this->assertXmlStringEqualsXmlString($expected, $data);
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return ModuleConfig
     */
    protected function getBuilder(string $setupVersion = null, array $sequences = [])
    {
        return new ModuleConfig($this->module, $this->vendor, $setupVersion, $sequences);
    }
}
