<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Exception\Container;

class ResourceModel extends Model
{
    
    /** @var string */
    protected $objectType = 'Model/ResourceModel';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Resource Model already exists. Cannot be created again.');
        }
    
        $builder = $this->getTemplateBuilder();
    
        $builder->addUse($this->getParentClass());
        $builder->setExtends($this->getParentClass());
    
        // $this->prepareObjectMethods($builder);
    
        $this->template = $builder->build();
    
        return $this->template;
    }
    
    
    /**
     * @param PhpClassBuilder $builder
     *
     * @return $this
     */
    protected function prepareObjectMethods(PhpClassBuilder $builder)
    {
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\Model\ResourceModel\Db\AbstractDb";
    }
}
