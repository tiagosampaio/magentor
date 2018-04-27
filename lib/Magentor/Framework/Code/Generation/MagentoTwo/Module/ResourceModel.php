<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Exception\Container;

class ResourceModel extends AbstractModulePhp
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
    
        return parent::build();
    }
    
    
    /**
     * @param PhpClassBuilder $builder
     *
     * @return $this
     */
    public function buildDefaultMethod(string $tableName = 'database_table', $fieldName = 'id_field')
    {
        $this->getTemplate()
             ->getMethod('_construct')
             ->setVisibility('protected')
             ->addBody("\$this->_init('{$tableName}', '{$fieldName}');")
             ->addComment("Initialize database relation.\n")
             ->addComment("@return void")
        ;
        
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
