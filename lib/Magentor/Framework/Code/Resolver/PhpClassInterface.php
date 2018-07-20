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
     * @param string|null $class
     * @param string|null $alias
     */
    public function __construct(string $class = null, string $alias = null);


    /**
     * @param string      $class
     * @param null|string $alias
     *
     * @return $this
     */
    public function renew(string $class, string $alias = null);


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
    public function getAlias() : string;


    /**
     * @return string
     */
    public function getClassPath() : string;
    
    
    /**
     * @param bool        $absoluteClass
     * @param null|string $suffix
     *
     * @return string
     */
    public function getFullClassName(bool $absoluteClass = false, $suffix = null) : string;
    
    
    /**
     * @param null|string $suffix
     *
     * @return string
     */
    public function getClassReference() : string;
    
    
    /**
     * @param null|string $suffix
     *
     * @return string
     */
    public function getAbsoluteClassName($suffix = null) : string;
    
    
    /**
     * @return string
     */
    public function getAbsoluteClassReference() : string;


    /**
     * @return array
     */
    public function getParts() : array;
}
