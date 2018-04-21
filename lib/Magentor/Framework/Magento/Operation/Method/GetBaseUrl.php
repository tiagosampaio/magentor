<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodInitializedAbstract;

class GetBaseUrl extends MethodInitializedAbstract
{

    /**
     * @inheritdoc
     */
    public function executeMagentoOne()
    {
        list($secure) = func_get_args();

        try {
            return \Mage::getBaseUrl('link', (bool) $secure);
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
