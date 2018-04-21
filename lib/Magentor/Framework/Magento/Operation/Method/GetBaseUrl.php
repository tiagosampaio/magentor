<?php

namespace Magentor\Framework\Magento\Operation\Method;

use Magentor\Framework\Magento\Operation\MethodAbstract;

class GetBaseUrl extends MethodAbstract
{

    /** @var bool */
    protected $initMagento = true;

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
