<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\CustomConfig\Config;
use MagentorTest\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\XmlConfigTestAbstract;

class ConfigTest extends XmlConfigTestAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:framework:Module/etc/custom_config.xsd';
    
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
  <custom_config/>
</config>

XML;

        /** @var Config $builder */
        $builder  = new Config('CustomConfig', 'Magentor');
        
        /** @var \Magentor\Framework\Code\Template\Xml\Config\CustomConfig\Config $template */
        $template = $builder->build();
        $template->setSchemaLocation($this->schemaLocation);
        
        $this->assertSame($expectedContent, $template->toXml());
    }
}
