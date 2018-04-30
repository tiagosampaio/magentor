<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\Config\Module as ModuleTemplate;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;

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
        
        $template = $this->getTemplate('0.1.0');
        $this->assertXmlStringEqualsXmlString($expected, (string) $template->toXml());
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
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
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
            
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return ModuleTemplate
     */
    protected function getTemplate(string $setupVersion = null)
    {
        $template = TemplateFactory::buildModuleTemplate();
    
        $template->build();
        $template->setModuleName($this->vendor . '_' . $this->module);
        $template->setSetupVersion($setupVersion);
        
        return $template;
    }
}
