<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetIsInstalled extends MethodAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        $this->beforeCall(true);
        return (bool) \Mage::isInstalled();
    }


    /**
     * @inheritdoc
     */
    public function executeMagentoTwo()
    {
        return false;
    }
}
