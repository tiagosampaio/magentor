<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetStoreConfig extends MethodAbstract
{

    protected $initMagento = true;


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
