<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetModuleDir extends MethodAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        return \Mage::getModuleDir();
    }


    /**
     * @inheritdoc
     */
    public function executeMagentoTwo()
    {
        return false;
    }
}
