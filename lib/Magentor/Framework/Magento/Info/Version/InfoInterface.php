<?php

namespace Magentor\Framework\Magento\Info\Version;

use Magentor\Framework\Magento\ApplicationInterface;
use Magentor\Framework\Magento\Info\Version;

interface InfoInterface
{

    /**
     * InfoInterface constructor.
     *
     * @param ApplicationInterface $magento
     */
    public function __construct(ApplicationInterface $magento);


    /**
     * Returns whether if it's a Magento One instance.
     *
     * @return bool
     */
    public function isMagentoOne();


    /**
     * Returns whether if it's a Magento Two instance.
     *
     * @return bool
     */
    public function isMagentoTwo();


    /**
     * Returns whether if it's not a Magento instance.
     *
     * @return bool
     */
    public function isNotMagento();


    /**
     * @return Version
     */
    public function versionInstance();
}
