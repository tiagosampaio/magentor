<?php

namespace Magentor\Framework\Magento\Operation;

use Magentor\Framework\Magento\ApplicationInterface;

abstract class MethodAbstract implements MethodInterface
{

    /** @var bool */
    protected $initMagento = false;

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
    public function requiresMagentoInitialization()
    {
        return $this->initMagento;
    }


    /**
     * @return bool|mixed
     */
    public function execute()
    {
        return false;
    }


    /**
     * @return \Magentor\Framework\Magento\Info\Version\InfoInterface
     */
    protected function getVersionInfo()
    {
        return $this->getMagentoApplication()->getInfo();
    }


    /**
     * @return ApplicationInterface
     */
    protected function getMagentoApplication()
    {
        return $this->magento;
    }
}
