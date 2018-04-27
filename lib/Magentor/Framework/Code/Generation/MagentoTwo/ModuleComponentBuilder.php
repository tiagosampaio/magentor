<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo;

use Magentor\Framework\Exception\Container;
use Magentor\Framework\Exception\GenericException;

class ModuleComponentBuilder
{
    
    const TYPE_MODEL               = 'model';
    const TYPE_RESOURCE_MODEL      = 'resource-model';
    const TYPE_RESOURCE_COLLECTION = 'resource-collection';
    const TYPE_CONTROLLER          = 'controller';
    const TYPE_HELPER              = 'helper';
    
    protected static $makers = [
        self::TYPE_MODEL               => Module\Model::class,
        self::TYPE_RESOURCE_MODEL      => Module\ResourceModel::class,
        self::TYPE_RESOURCE_COLLECTION => Module\ResourceModel::class,
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
        $component = self::build(self::TYPE_MODEL, [$name, $module, $vendor]);
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
        $component = self::build(self::TYPE_RESOURCE_MODEL, [$name, $module, $vendor]);
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
            Container::throwGenericException('Component maker class does not exist.');
        }
        
        return self::$makers[$type];
    }
}
