<?php

namespace Magentor\MagentoInfo\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetVersion extends MethodAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        return \Mage::getVersion();
    }


    /**
     * @inheritdoc
     */
    public function executeMagentoTwo()
    {
        return false;
    }
}
