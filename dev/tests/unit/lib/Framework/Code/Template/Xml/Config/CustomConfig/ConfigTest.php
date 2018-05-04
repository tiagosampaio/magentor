<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config\Custom;

use Magentor\Framework\Code\Template\Xml\Config\CustomConfig\Config;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;
use MagentorTest\Framework\Code\Template\Xml\Config\XmlConfigAbstract;

class ConfigTest extends XmlConfigAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:Module/etc/custom_config.xsd';
    
    
    /**
     * @test
     */
    public function defaultModuleConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <custom_config/>
</config>
XML;
        
        $template = $this->getTemplate();
        $this->assertXmlStringEqualsXmlString($expected, (string) $template->toXml());
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return Config
     */
    protected function getTemplate()
    {
        $template = TemplateFactory::buildCustomConfigTemplate();
    
        $template->build();
        $template->setSchemaLocation($this->schemaLocation);
        
        return $template;
    }
}
