<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig\Data;
use MagentorTest\Framework\TestCase;

class DataTest extends TestCase
{
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<PHP
<?php
namespace Magentor\CustomConfig\Model\Config;

use Magento\Framework\Config\Data as ConfigData;

class Data extends ConfigData
{
}

PHP;

        /** @var Data $builder */
        $builder  = new Data('Data', 'CustomConfig', 'Magentor');
        $builder->setDirAutoCreation(false);
        $builder->setRenderDoc(false);
        $content = (string) $builder->build();
        
        $this->assertSame($expectedContent, $content);
    }
}
