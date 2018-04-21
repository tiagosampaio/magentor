<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetStoreConfig extends MethodAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne($path, $store = null)
    {
        try {
            return \Mage::getStoreConfig($path, $store);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return \Mage::getStoreConfig();
    }


    /**
     * @inheritdoc
     */
    public function executeMagentoTwo()
    {
        return false;
    }
}
