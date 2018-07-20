<?php

namespace Magentor\Framework\Magento\Info\Version;

use Magentor\Framework\Magento\ApplicationInterface;

abstract class InfoAbstract implements InfoInterface
{

    /** @var ApplicationInterface */
    protected $magento;


    /**
     * @inheritdoc
     */
    public function __construct(ApplicationInterface $magento)
    {
        $this->magento = $magento;
    }


    /**
     * @inheritdoc
     */
    public function isMagentoOne()
    {
        return false;
    }


    /**
     * @inheritdoc
     */
    public function isMagentoTwo()
    {
        return false;
    }


    /**
     * @inheritdoc
     */
    public function isNotMagento()
    {
        return !$this->isMagentoOne() && !$this->isMagentoTwo();
    }


    /**
     * @inheritdoc
     */
    public function versionInstance()
    {
        return new Version($this);
    }
}
