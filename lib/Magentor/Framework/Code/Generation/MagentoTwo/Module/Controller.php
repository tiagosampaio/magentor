<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\Container;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\Parameter;
use Nette\PhpGenerator\Property;

class Controller extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Controller';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Controller already exists. Cannot be created again.');
        }
        
        $this->buildDefault();
        
        return $this->getTemplate();
    }
    
    
    /**
     * @return $this
     */
    public function buildDefault()
    {
        $pageFactoryClass = "Magento\Framework\View\Result\PageFactory";
        $contextClass     = "Magento\Framework\App\Action\Context";
    
        /** @var Property $property */
        $property = $this->getTemplate()->addProperty("resultPageFactory");
        $property->setVisibility('protected');
        $property->addComment("@var \Magento\Framework\View\Result\PageFactory");
        
        $this->getTemplate()->addUse($pageFactoryClass);
        $this->getTemplate()->addUse($contextClass);
        
        /** @var Method $constructor */
        $constructor = $this->getTemplate()
                            ->getMethod('__construct');
        
        /** @var Parameter $context */
        $context = $constructor->addParameter('context');
        $context->setTypeHint($contextClass);
        
        /** @var Parameter $resultPageFactory */
        $resultPageFactory = $constructor->addParameter('resultPageFactory');
        $resultPageFactory->setTypeHint($pageFactoryClass);
        
        $constructor->addComment('@var Context $context');
        $constructor->addComment('@var PageFactory $resultPageFactory');
    
        $constructor->addBody("parent::__construct(\$context);");
        $constructor->addBody("\$this->resultPageFactory = \$resultPageFactory;");
        
        /** @var Method $execute */
        $execute = $this->getTemplate()
                       ->getMethod('execute')
                       ->setVisibility('public')
                       ->addComment("Start by creating your controller's logic...\n")
                       ->addComment("@return \Magento\Framework\View\Result\Page")
        ;
    
        $execute->addBody("\$resultPage = \$this->resultPageFactory->create();");
        $execute->addBody("return \$resultPage;");
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\App\Action\Action";
    }
    
    
    /**
     * @return array
     */
    protected function getInterfacesClasses()
    {
        return [
            "Magento\Catalog\Controller\Product\View\ViewInterface"
        ];
    }
}
