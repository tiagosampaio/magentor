<?php

namespace Magentor\Framework\Magento\Operation;


use Magentor\Framework\Exception\GenericException;

interface CommandInterface
{

    /**
     * @return string
     */
    public function getVersion();


    /**
     * @return string
     */
    public function getEdition();


    /**
     * @return string
     */
    public function getEditionInfo();


    /**
     * @var string $name
     * @var string $type
     *
     * @return string
     *
     * @throws GenericException
     */
    public function getModuleDir($name, $type = 'etc');


    /**
     * @return string
     */
    public function getBaseDir();


    /**
     * @param string   $path
     * @param int|null $store
     *
     * @return string|null|mixed
     */
    public function getStoreConfig($path, $store = null);


    /**
     * @param bool|null $secure
     *
     * @return string
     */
    public function getBaseUrl($secure = null);


    /**
     * @return bool
     */
    public function isInstalled();
}
