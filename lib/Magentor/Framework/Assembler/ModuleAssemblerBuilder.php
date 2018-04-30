<?php

namespace Magentor\Framework\Assembler;

use Magentor\Framework\Magento\Module\Component\Type;

class ModuleAssemblerBuilder
{
    
    /** @var array */
    protected static $types = [
        Type::TYPE_MODEL                => Module\Model::class,
        Type::TYPE_RESOURCE_MODEL       => Module\ResourceModel::class,
        Type::TYPE_RESOURCE_COLLECTION  => Module\ResourceCollection::class,
        Type::TYPE_CONTROLLER           => Module\Controller::class,
        Type::TYPE_HELPER               => Module\Helper::class,
        Type::TYPE_CONFIG_SOURCE        => Module\ConfigSource::class,
        Type::TYPE_SETUP_INSTALL_SCHEMA => Module\SetupInstallSchema::class,
//        Type::TYPE_XML_CONFIG_MODULE   => Module\XmlConfig\ModuleConfig::class,
    ];
    
    
    /**
     * @param string $type
     * @param array  $arguments
     *
     * @return Module\ModuleInterface
     */
    public static function build(string $type, array $arguments = [])
    {
        $class = self::$types[$type];
        return new $class(...$arguments);
    }
}
