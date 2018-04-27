<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\Container;
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
            Container::throwGenericException('Model already exists. Cannot be created again.');
        }
    
        $builder = $this->getTemplateBuilder();
        
        $builder->addUse($this->getParentClass());
        $builder->setExtends($this->getParentClass());
        
        $this->template = $builder->build();
        
        return $this->template;
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
            $method->addBody("\$this->_init({$resourceClass});");
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
