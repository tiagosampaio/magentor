<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\Container;
use Nette\PhpGenerator\Method;

class ResourceCollection extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model/ResourceModel';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Resource Collection already exists. Cannot be created again.');
        }
    
        return parent::build();
    }
    
    
    /**
     * @param PhpClassBuilder $builder
     *
     * @return $this
     */
    public function buildDefaultMethod(string $modelClass = null, $resourceModelClass = null)
    {
        /** @var Method $method */
        $method = $this->getTemplate()
             ->getMethod('_construct')
             ->setVisibility('protected')
             ->addComment("Initialize resource model\n")
             ->addComment("@return void")
        ;
        
        if ($modelClass && $resourceModelClass) {
            $model    = new PhpClassResolver($modelClass);
            $resource = new PhpClassResolver($resourceModelClass, 'ResourceModel');
            
            $this->getTemplate()->addUse($model->getFullClassName());
            $this->getTemplate()->addUse($resource->getFullClassName(), $resource->getAlias());
            
            $method->addBody("\$this->_init({$model->getClassNameReference()}, {$resource->getAliasReference()});");
        } else {
            $method->addBody("/** @todo Call \$this->_init(ModelClass, ResourceModelClass) */");
        }
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection";
    }
}
