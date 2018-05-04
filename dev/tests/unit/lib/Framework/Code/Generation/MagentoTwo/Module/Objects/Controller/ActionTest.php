<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\Objects\Controller;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Controller;
use MagentorTest\Framework\TestCase;

class ActionTest extends TestCase
{
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<PHP
<?php
namespace Magentor\CustomController\Controller\Path;

use Magento\Catalog\Controller\Product\View\ViewInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class ControllerAction extends Action implements ViewInterface
{
    /** @var PageFactory */
    protected \$resultPageFactory;


    /**
     * @var Context \$context
     * @var PageFactory \$resultPageFactory
     */
    public function __construct(Context \$context, PageFactory \$resultPageFactory)
    {
        parent::__construct(\$context);
        \$this->resultPageFactory = \$resultPageFactory;
    }


    /**
     * Start by creating your controller's logic...
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        \$resultPage = \$this->resultPageFactory->create();
        return \$resultPage;
    }
}

PHP;

        /** @var Controller $builder */
        $builder  = new Controller('Path/ControllerAction', 'CustomController', 'Magentor');
        $builder->setDirAutoCreation(false);
        $builder->setRenderDoc(false);
        
        $content = (string) $builder->build();
        
        $this->assertSame($expectedContent, $content);
    }
}
