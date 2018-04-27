<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceModel as ResourceModelBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceCollection as ResourceCollectionBuilder;

class ResourceModel implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     *
     * @return ResourceModelBuilder
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, string $modelName, array $options = [])
    {
        /** @var ResourceModelBuilder $builder */
        $builder = ModuleComponentBuilder::buildResourceModel($modelName, $module, $vendor);
        
        $tableName = 'table_name';
        if (isset($options['table'])) {
            $tableName = $options['table'];
        }
    
        $tableField = 'field_name';
        if (isset($options['field'])) {
            $tableField = $options['field'];
        }
        
        $builder->buildDefaultMethod($tableName, $tableField);
        
        return $builder;
    }
    
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     *
     * @return ResourceCollectionBuilder
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function createResourceCollection(string $vendor, string $module, string $modelName, array $options = [])
    {
        $modelName .= DS . 'Collection';
        
        /** @var ResourceCollectionBuilder $builder */
        $builder = ModuleComponentBuilder::buildResourceCollection($modelName, $module, $vendor);
    
        $modelClass = null;
        if (isset($options['model'])) {
            $modelClass = $options['model'];
        }
    
        $resourceModelClass = null;
        if (isset($options['resource'])) {
            $resourceModelClass = $options['resource'];
        }
        
        $builder->buildDefaultMethod($modelClass, $resourceModelClass);
        
        return $builder;
    }
}
