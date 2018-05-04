<?php

namespace Magentor\Framework\Code\Template\Xml;

use Magentor\Framework\Code\Template\Xml\Config\Acl;
use Magentor\Framework\Code\Template\Xml\Config\Config;
use Magentor\Framework\Code\Template\Xml\Config\Menu;
use Magentor\Framework\Code\Template\Xml\Config\Module;
use Magentor\Framework\Code\Template\Xml\Config\Routes;
use Magentor\Framework\Code\Template\Xml\Config\CustomConfig\Config as CustomConfig;
use Magentor\Framework\Code\Template\Xml\Config\CustomConfig\Schema as CustomSchema;
use Magentor\Framework\Magento\Module\Component\Type;

class TemplateFactory
{
    
    /** @var string */
    protected static $parentNode = '<config/>';
    
    
    protected static $xsiUrl = 'http://www.w3.org/2001/XMLSchema-instance';
    
    /** @var array */
    protected static $types = [
        Type::TYPE_XML_CONFIG_MODULE        => Module::class,
        Type::TYPE_XML_CONFIG_ACL           => Acl::class,
        Type::TYPE_XML_CONFIG_CONFIG        => Config::class,
        Type::TYPE_XML_CONFIG_ROUTES        => Routes::class,
        Type::TYPE_XML_CONFIG_MENU          => Menu::class,
        Type::TYPE_XML_CONFIG_CUSTOM        => CustomConfig::class,
        Type::TYPE_XML_CONFIG_CUSTOM_SCHEMA => CustomSchema::class,
    ];
    
    /** @var array */
    protected static $schemaLocations = [
        Type::TYPE_XML_CONFIG_MODULE => 'urn:magento:framework:Module/etc/module.xsd',
        Type::TYPE_XML_CONFIG_ACL    => 'urn:magento:framework:acl/etc/acl.xsd',
        Type::TYPE_XML_CONFIG_CONFIG => 'urn:magento:module:Magento_Store:etc/config.xsd',
        Type::TYPE_XML_CONFIG_ROUTES => 'urn:magento:framework:App/etc/routes.xsd',
        Type::TYPE_XML_CONFIG_MENU   => 'urn:magento:module:Magento_Backend:etc/menu.xsd',
        Type::TYPE_XML_CONFIG_CUSTOM => null,
    ];
    
    
    /**
     * @return Acl
     */
    public static function buildAclTemplate()
    {
        /** @var Acl $template */
        $template = self::build(Type::TYPE_XML_CONFIG_ACL);
        return $template;
    }
    
    
    /**
     * @return Routes
     */
    public static function buildRoutesTemplate()
    {
        /** @var Routes $template */
        $template = self::build(Type::TYPE_XML_CONFIG_ROUTES);
        return $template;
    }
    
    
    /**
     * @return Menu
     */
    public static function buildMenuTemplate()
    {
        /** @var Menu $template */
        $template = self::build(Type::TYPE_XML_CONFIG_MENU);
        return $template;
    }
    
    
    /**
     * @return Module
     */
    public static function buildModuleTemplate()
    {
        /** @var Module $template */
        $template = self::build(Type::TYPE_XML_CONFIG_MODULE);
        return $template;
    }
    
    
    /**
     * @return Config
     */
    public static function buildConfigTemplate()
    {
        /** @var Config $template */
        $template = self::build(Type::TYPE_XML_CONFIG_CONFIG);
        return $template;
    }
    
    
    /**
     * @return CustomConfig
     */
    public static function buildCustomConfigTemplate()
    {
        /** @var CustomConfig $template */
        $template = self::build(Type::TYPE_XML_CONFIG_CUSTOM);
        return $template;
    }
    
    
    /**
     * @return CustomSchema
     */
    public static function buildCustomSchemaTemplate()
    {
        /** @var CustomSchema $template */
        $template = new CustomSchema();
        $template->setXsUrl();
        
        return $template;
    }
    
    
    /**
     * @param string $type
     *
     * @return ConfigElement
     */
    public static function build(string $type, string $parentNode = null)
    {
        if (!$parentNode) {
            $parentNode = self::$parentNode;
        }
        
        /** @var ConfigElement $template */
        $template = new self::$types[$type]($parentNode, LIBXML_NOERROR, false, 'ws', true);
        $template->setXsiUrl(self::$xsiUrl);
        
        if (isset(self::$schemaLocations[$type]) && self::$schemaLocations[$type]) {
            $template->setSchemaLocation(self::$schemaLocations[$type]);
        }
        
        return $template;
    }
}
