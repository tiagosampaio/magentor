<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodInitializedAbstract;

class GetStoreConfig extends MethodInitializedAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        list($path, $storeId) = func_get_args();

        try {
            return \Mage::getStoreConfig($path, $storeId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @inheritdoc
     */
    public function executeMagentoTwo()
    {
        return false;
    }
}
