<?php

namespace Magentor\Framework\Magento\Module\Component;

class Type
{
    
    const TYPE_MODEL               = 'model';
    const TYPE_RESOURCE_MODEL      = 'resource_model';
    const TYPE_RESOURCE_COLLECTION = 'resource_collection';
    const TYPE_CONTROLLER          = 'controller';
    const TYPE_HELPER              = 'helper';
    const TYPE_BLOCK               = 'block';
    const TYPE_CONFIG_SOURCE       = 'config_source';
    
    /**
     * Config Options
     */
    const TYPE_XML_CONFIG_MODULE   = 'xml_config_module';
    const TYPE_XML_CONFIG_ROUTES   = 'xml_config_routes';
    const TYPE_XML_CONFIG_ACL      = 'xml_config_acl';
    const TYPE_XML_CONFIG_CONFIG   = 'xml_config_config';
}
