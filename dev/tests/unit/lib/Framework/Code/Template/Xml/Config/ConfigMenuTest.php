<?php

namespace MagentorTest\Framework\Code\Template\Xml\Config;

use Magentor\Framework\Code\Template\Xml\Config\Menu as MenuTemplate;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;

class ConfigMenuTest extends XmlConfigAbstract
{
    
    /** @var string */
    protected $schemaLocation = 'urn:magento:module:Magento_Backend:etc/menu.xsd';
    
    
    /**
     * @test
     */
    public function defaultMenuConfig()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <menu/>
</config>
XML;
        
        $template = $this->getTemplate();
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function menuConfigWithOneMenu()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <menu>
        <add id="{$this->getModuleName()}::test" resource="{$this->getModuleName()}::test" sortOrder="10" title="test" translate="title"/>
    </menu>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addMenu($this->getModuleName(), 'test', 'Test', "{$this->getModuleName()}::test");
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function menuConfigWithOneParent()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <menu>
        <add id="{$this->getModuleName()}::test" resource="{$this->getModuleName()}::test" sortOrder="10" title="test" translate="title"/>
        <add id="{$this->getModuleName()}::second" resource="{$this->getModuleName()}::second" sortOrder="10" title="Second" translate="title" parent="{$this->getModuleName()}::test"/>
    </menu>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addMenu($this->getModuleName(), 'test', 'Test', "{$this->getModuleName()}::test");
        $template->addMenu($this->getModuleName(), 'second', 'Second', "{$this->getModuleName()}::second", 10, "{$this->getModuleName()}::test");
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @test
     */
    public function menuConfigWithManyParents()
    {
        $expected = <<<XML
<?xml version="1.0"?>
<config xmlns:xsi="{$this->xsiUrl}" xsi:noNamespaceSchemaLocation="{$this->schemaLocation}">
    <menu>
        <add id="{$this->getModuleName()}::parent1" resource="{$this->getModuleName()}::parent1" sortOrder="10" title="Parent 1" translate="title"/>
        <add id="{$this->getModuleName()}::parent2" resource="{$this->getModuleName()}::parent2" sortOrder="20" title="Parent 2" translate="title"/>
        <add id="{$this->getModuleName()}::parent3" resource="{$this->getModuleName()}::parent3" sortOrder="30" title="Parent 3" translate="title"/>
        
        <add id="{$this->getModuleName()}::child1" resource="{$this->getModuleName()}::child1" sortOrder="10" title="Child 1" translate="title" parent="{$this->getModuleName()}::parent1"/>
        <add id="{$this->getModuleName()}::child2" resource="{$this->getModuleName()}::child2" sortOrder="10" title="Child 2" translate="title" parent="{$this->getModuleName()}::parent2"/>
        <add id="{$this->getModuleName()}::child3" resource="{$this->getModuleName()}::child3" sortOrder="10" title="Child 3" translate="title" parent="{$this->getModuleName()}::parent3"/>
        
        <add id="{$this->getModuleName()}::sub_child1" resource="{$this->getModuleName()}::sub_child1" sortOrder="10" title="Sub Child 1" translate="title" parent="{$this->getModuleName()}::child1"/>
        <add id="{$this->getModuleName()}::sub_child2" resource="{$this->getModuleName()}::sub_child2" sortOrder="10" title="Sub Child 2" translate="title" parent="{$this->getModuleName()}::child2"/>
        <add id="{$this->getModuleName()}::sub_child3" resource="{$this->getModuleName()}::sub_child3" sortOrder="10" title="Sub Child 3" translate="title" parent="{$this->getModuleName()}::child3"/>
    </menu>
</config>
XML;
        
        $template = $this->getTemplate();
        $template->addMenu($this->getModuleName(), 'parent1', 'Parent 1', "{$this->getModuleName()}::parent1", 10);
        $template->addMenu($this->getModuleName(), 'parent2', 'Parent 2', "{$this->getModuleName()}::parent2", 20);
        $template->addMenu($this->getModuleName(), 'parent3', 'Parent 3', "{$this->getModuleName()}::parent3", 30);
        
        $template->addMenu($this->getModuleName(), 'child1', 'Child 1', "{$this->getModuleName()}::child1", 10, "{$this->getModuleName()}::parent1");
        $template->addMenu($this->getModuleName(), 'child2', 'Child 2', "{$this->getModuleName()}::child2", 10, "{$this->getModuleName()}::parent2");
        $template->addMenu($this->getModuleName(), 'child3', 'Child 3', "{$this->getModuleName()}::child3", 10, "{$this->getModuleName()}::parent3");
        
        $template->addMenu($this->getModuleName(), 'sub_child1', 'Sub Child 1', "{$this->getModuleName()}::sub_child1", 10, "{$this->getModuleName()}::child1");
        $template->addMenu($this->getModuleName(), 'sub_child2', 'Sub Child 2', "{$this->getModuleName()}::sub_child2", 10, "{$this->getModuleName()}::child2");
        $template->addMenu($this->getModuleName(), 'sub_child3', 'Sub Child 3', "{$this->getModuleName()}::sub_child3", 10, "{$this->getModuleName()}::child3");
        
        $this->assertXmlStringEqualsXmlString($expected, $template->toXml());
    }
    
    
    /**
     * @param string $setupVersion
     * @param array  $sequences
     *
     * @return MenuTemplate
     */
    protected function getTemplate()
    {
        $template = TemplateFactory::buildMenuTemplate();
        $template->build();
        
        return $template;
    }
}
