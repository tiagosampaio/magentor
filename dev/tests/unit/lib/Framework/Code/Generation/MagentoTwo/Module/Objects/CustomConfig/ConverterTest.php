<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig\Converter;
use MagentorTest\Framework\TestCase;

class ConverterTest extends TestCase
{
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<PHP
<?php
namespace Magentor\CustomConfig\Model\Config;

use Magento\Framework\Config\ConverterInterface;

class Converter implements ConverterInterface
{
    /**
     * @inheritdoc
     */
    public function convert(\$source)
    {
        /** @var \DOMXPath \$xpath */
        \$xpath = new \DOMXPath(\$source);

        /**
         * @var \DOMNodeList \$configNode
         */
        \$configNode = \$xpath->evaluate('/config/sample');

        \$config = [];

        /** @var \DOMElement \$_blacklistNode */
        foreach (\$configNode as \$_configNode) {
            \$code = \$this->_getAttributeValue(\$_configNode, 'code');
            \$blacklist[\$code] = \$code;
        }

        return [
            'config'  => \$config,
            'attributes' => \$attributes
        ];
    }


    /**
     * Get attribute value
     *
     * @param \DOMNode    \$input
     * @param string      \$attributeName
     * @param string|null \$default
     *
     * @return null|string
     */
    protected function _getAttributeValue(\DOMNode \$input, \$attributeName, \$default = null)
    {
        \$node = \$input->attributes->getNamedItem(\$attributeName);
        return \$node ? \$node->nodeValue : \$default;
    }
}

PHP;

        /** @var Converter $builder */
        $builder  = new Converter('Converter', 'CustomConfig', 'Magentor');
        $builder->setDirAutoCreation(false);
        $builder->setRenderDoc(false);
        $content = (string) $builder->build();
        
        $this->assertSame($expectedContent, $content);
    }
}
