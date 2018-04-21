<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetBaseUrl extends MethodAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        $parameters = func_get_args();

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
