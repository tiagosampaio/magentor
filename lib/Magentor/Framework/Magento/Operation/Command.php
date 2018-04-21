<?php

namespace Magentor\Framework\Magento\Operation;


class Command extends CommandAbstract
{

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->executeCommand(Method\GetVersion::class);
    }

    /**
     * @return string
     */
    public function getEdition()
    {
        return $this->executeCommand(Method\GetEdition::class);
    }


    /**
     * @return string
     */
    public function getEditionInfo()
    {
        return $this->executeCommand(Method\GetEditionInfo::class);
    }


    /**
     * @return string
     */
    public function getBaseDir()
    {
        return $this->executeCommand(Method\GetBaseDir::class);
    }


    /**
     * @return string
     */
    public function getModuleDir()
    {
        return $this->executeCommand(Method\GetModuleDir::class);
    }


    /**
     * @param string   $path
     * @param int|null $store
     *
     * @return string
     */
    public function getStoreConfig($path, $store = null)
    {
        return $this->executeCommand(Method\GetStoreConfig::class, [$path, $store]);
    }


    /**
     * @inheritdoc
     */
    public function getBaseUrl($secure = null)
    {
        return $this->executeCommand(Method\GetBaseUrl::class, [$secure]);
    }


    /**
     * @return bool
     */
    public function isInstalled()
    {
        return $this->executeCommand(Method\GetIsInstalled::class);
    }
}
