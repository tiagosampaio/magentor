<?php
/**
 * Created by PhpStorm.
 * User: tiagosampaio
 * Date: 26/04/18
 * Time: 10:30
 */

namespace Magentor\Framework\Code\Resolver;


interface PhpClassInterface
{

    /**
     * PhpClassInterface constructor.
     *
     * @param string $class
     */
    public function __construct(string $class);


    /**
     * @param string $class
     *
     * @return $this
     */
    public function renew(string $class);


    /**
     * @return string
     */
    public function getVendor();
    
    
    /**
     * @param string $vendor
     *
     * @return $this
     */
    public function setVendor(string $vendor);


    /**
     * @return string
     */
    public function getPackage();
    
    
    /**
     * @param string $package
     *
     * @return $this
     */
    public function setPackage(string $package);


    /**
     * @return string
     */
    public function getNamespace();


    /**
     * @return string
     */
    public function getClassName();
    
    
    /**
     * @param string $className
     *
     * @return $this
     */
    public function setClassName(string $className);


    /**
     * @return string
     */
    public function getClassPath();


    /**
     * @return string
     */
    public function getFullClassName();


    /**
     * @return array
     */
    public function getParts();
}