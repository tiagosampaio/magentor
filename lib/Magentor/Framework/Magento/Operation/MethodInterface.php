<?php
/**
 * Created by PhpStorm.
 * User: tiagosampaio
 * Date: 21/04/18
 * Time: 13:49
 */

namespace Magentor\Framework\Magento\Operation;


use Magentor\Framework\Magento\ApplicationInterface;

interface MethodInterface
{

    /**
     * MethodInterface constructor.
     *
     * @param ApplicationInterface $magento
     */
    public function __construct(ApplicationInterface $magento);


    /**
     * @return mixed
     */
    public function execute();


    /**
     * @return mixed
     */
    public function executeMagentoOne();


    /**
     * @return mixed
     */
    public function executeMagentoTwo();


    /**
     * @return boolean
     */
    public function requiresMagentoInitialization();
}
