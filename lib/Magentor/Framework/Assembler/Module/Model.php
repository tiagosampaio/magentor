<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Assembler\ModuleAssemblerBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceModel as ResourceModelBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\ResourceCollection as ResourceCollectionBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\Model as ModelBuilder;
use Magentor\Framework\Magento\Module\Component\Type;

class Model implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     * @param bool   $createResources
     *
     * @return ModelBuilder
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, string $modelName, array $options = [])
    {
        /** @var ModelBuilder $builder */
        $builder = ModuleComponentBuilder::buildModel($modelName, $module, $vendor);
    
        $resourceClass   = null;
        $createResources = false;
        
        if (isset($options['resources']) && (true == $options['resources'])) {
            $createResources = true;
        }
    
        if (true === $createResources) {
            /** @var ResourceModel $assemblerResourceModel */
            $assemblerResourceModel = ModuleAssemblerBuilder::build(Type::TYPE_RESOURCE_MODEL);
            
            $resourceBuilder = $assemblerResourceModel->create($vendor, $module, $modelName, $options);
            $resourceClass   = $resourceBuilder->classResolver()
                                               ->getFullClassName();
    
            /** @var ResourceCollection $assemblerResourceCollection */
            $assemblerResourceCollection = ModuleAssemblerBuilder::build(Type::TYPE_RESOURCE_COLLECTION);
            
            $collectionBuilder = $assemblerResourceCollection->create($vendor, $module, $modelName, [
                'model'    => $builder->classResolver()->getFullClassName(),
                'resource' => $resourceClass,
            ]);
    
            $resourceBuilder->write();
            $collectionBuilder->write();
        }
    
        $builder->buildDefaultMethod($resourceClass);
        $builder->write();
        
        return $builder;
    }
}
