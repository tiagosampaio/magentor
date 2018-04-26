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

    const TYPE_MODULE = 'module';
    const TYPE_FRAMEWORK = 'framework';

    /**
     * PhpClassInterface constructor.
     *
     * @param string $class
     * @param string $type
     */
    public function __construct(string $class, string $type = self::TYPE_MODULE);


    /**
     * @return string
     */
    public function getVendor();


    /**
     * @return string
     */
    public function getPackage();


    /**
     * @return string
     */
    public function getNamespace();


    /**
     * @return string
     */
    public function getClassName();


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