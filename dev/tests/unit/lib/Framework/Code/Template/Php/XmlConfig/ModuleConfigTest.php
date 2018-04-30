<?php

namespace MagentorTest\Framework\Code\Template\Php\XmlConfig;

use Magentor\Framework\Code\Template\Xml\Config\Module as ModuleTemplate;

class ModuleConfigTest extends XmlConfigAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:Module/etc/module.xsd';
    
    
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
        
        $template = $this->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        
        $template = $this->getTemplate('3.2.1');
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
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
        
        $template = $this->getTemplate('3.2.1');
        $template->addSequence('Magento_Catalog')
                 ->addSequence('Magento_Backend')
                 ->addSequence('Magento_Quote');
            
        $this->assertXmlStringEqualsXmlString($expected, (string) $template);
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return ModuleTemplate
     */
    protected function getTemplate(string $setupVersion = null)
    {
        return new ModuleTemplate($this->module, $this->vendor, $setupVersion);
    }
}
