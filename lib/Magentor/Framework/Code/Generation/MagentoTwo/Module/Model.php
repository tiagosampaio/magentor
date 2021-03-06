<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\ExceptionContainer;
use Nette\PhpGenerator\Method;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    
    /**
     * @return PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            ExceptionContainer::throwGenericException('Model already exists. Cannot be created again.');
        }
    
        return parent::build();
    }
    
    
    /**
     * @param PhpClassBuilder $builder
     *
     * @return $this
     */
    public function buildDefaultMethod(string $resourceClass = null)
    {
        /** @var Method $method */
        $method = $this->getTemplate()->addMethod('_construct');
        $method->setVisibility('protected');
        
        if (!empty($resourceClass)) {
            $resolver = new PhpClassResolver($resourceClass, 'ResourceModel');
            
            $this->getTemplate()->addUse($resolver->getFullClassName(), $resolver->getAlias());
            $method->addBody("\$this->_init({$resolver->getAliasReference()});");
        }
        
        if (empty($resourceClass)) {
            $method->setBody('/** @todo Implement $this->_init() method here... */');
        }
        
        $method->addComment("Initialize resource model\n")
               ->addComment("@return void");
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\Model\AbstractModel";
    }
}
