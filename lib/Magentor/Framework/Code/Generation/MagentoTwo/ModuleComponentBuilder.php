<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo;

use Magentor\Framework\Exception\ExceptionContainer;
use Magentor\Framework\Exception\GenericException;
use Magentor\Framework\Magento\Module\Component\Type;

class ModuleComponentBuilder
{
 
    /** @var array */
    protected static $makers = [
        Type::TYPE_CONTROLLER          => Module\Controller::class,
        Type::TYPE_HELPER              => Module\Helper::class,
        Type::TYPE_MODEL               => Module\Model::class,
        Type::TYPE_RESOURCE_MODEL      => Module\ResourceModel::class,
        Type::TYPE_RESOURCE_COLLECTION => Module\ResourceCollection::class,
        Type::TYPE_CONFIG_SOURCE       => Module\ConfigSource::class,
        Type::TYPE_XML_CONFIG_MODULE   => Module\XmlConfig\ModuleConfig::class,
    ];
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return Module\Model
     *
     * @throws GenericException
     */
    public static function buildModel(string $name, string $module, string $vendor)
    {
        /** @var Module\Model $component */
        $component = self::build(Type::TYPE_MODEL, [$name, $module, $vendor]);
        return $component;
    }
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return Module\ResourceModel
     *
     * @throws GenericException
     */
    public static function buildResourceModel(string $name, string $module, string $vendor)
    {
        /** @var Module\ResourceModel $component */
        $component = self::build(Type::TYPE_RESOURCE_MODEL, [$name, $module, $vendor]);
        return $component;
    }
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return Module\Helper
     *
     * @throws GenericException
     */
    public static function buildHelper(string $name, string $module, string $vendor)
    {
        /** @var Module\Helper $component */
        $component = self::build(Type::TYPE_HELPER, [$name, $module, $vendor]);
        return $component;
    }
    
    
    /**
     * @param string $controllerName
     * @param string $module
     * @param string $vendor
     *
     * @return Module\Controller
     *
     * @throws GenericException
     */
    public static function buildController(string $controllerName, string $module, string $vendor)
    {
        /** @var Module\Controller $component */
        $component = self::build(Type::TYPE_CONTROLLER, [$controllerName, $module, $vendor]);
        return $component;
    }
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return Module\ResourceCollection
     *
     * @throws GenericException
     */
    public static function buildResourceCollection(string $name, string $module, string $vendor)
    {
        /** @var Module\ResourceCollection $component */
        $component = self::build(Type::TYPE_RESOURCE_COLLECTION, [$name, $module, $vendor]);
        return $component;
    }
    
    
    /**
     * @param string $module
     * @param string $vendor
     *
     * @return Module\XmlConfig\ModuleConfig
     *
     * @throws GenericException
     */
    public static function buildXmlConfigModule(
        string $module,
        string $vendor,
        string $setupVersion = null,
        array $sequence = []
    )
    {
        /** @var Module\XmlConfig\ModuleConfig $component */
        $component = self::build(Type::TYPE_XML_CONFIG_MODULE, [$module, $vendor, $setupVersion, $sequence]);
        return $component;
    }
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return Module\ResourceCollection
     *
     * @throws GenericException
     */
    public static function buildConfigSource(string $name, string $module, string $vendor)
    {
        /** @var Module\ResourceCollection $component */
        $component = self::build(Type::TYPE_CONFIG_SOURCE, [$name, $module, $vendor]);
        return $component;
    }
    
    
    /**
     * @param string $type
     * @param array  $parameters
     *
     * @return mixed
     *
     * @throws GenericException
     */
    public static function build(string $type, array $parameters = [])
    {
        $class     = self::getComponentClass($type);
        $component = new $class(...$parameters);
        
        return $component;
    }
    
    
    /**
     * @param string|null $type
     *
     * @return string
     *
     * @throws GenericException
     */
    protected static function getComponentClass(string $type)
    {
        if (!isset(self::$makers[$type])) {
            ExceptionContainer::throwGenericException('Component maker class does not exist.');
        }
        
        return self::$makers[$type];
    }
}
