<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodInitializedAbstract;

class GetModuleDir extends MethodInitializedAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        list($name, $type) = func_get_args();
        return \Mage::getModuleDir($type, $name);
    }


    /**
     * @inheritdoc
     */
    public function executeMagentoTwo()
    {
        return false;
    }
}
