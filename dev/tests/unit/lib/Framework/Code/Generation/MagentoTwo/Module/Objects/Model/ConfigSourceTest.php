<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\Objects\Model;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\ConfigSource;
use MagentorTest\Framework\TestCase;

class ConfigSourceTest extends TestCase
{
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<PHP
<?php
namespace Magentor\ConfigSource\Model\System\Config\Source\Disk;

use Magento\Framework\Option\ArrayInterface;

class Locations implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        \$options = [];

        foreach ((array) \$this->toArray() as \$value => \$label) {
            \$options[] = [
                'value' => \$value,
                'label' => \$label,
            ];
        }

        return \$options;
    }


    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            0 => __('Option One'),
            1 => __('Option Two'),
        ];
    }
}

PHP;

        /** @var ConfigSource $builder */
        $builder  = new ConfigSource('Disk/Locations', 'ConfigSource', 'Magentor');
        $builder->setDirAutoCreation(false);
        $builder->setRenderDoc(false);
        $content = (string) $builder->build();
        
        $this->assertSame($expectedContent, $content);
    }
}
