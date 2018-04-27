<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceCollection as ResourceCollectionBuilder;

class ResourceCollection implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     *
     * @return ResourceCollectionBuilder
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, string $modelName, array $options = [])
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
