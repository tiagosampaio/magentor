<?php

namespace Magentor\Framework\Code\Generation;

use Magentor\Framework\Code\Resolver\PhpClassResolver;

abstract class AbstractPhp
{
    
    /** @var string */
    protected $fileExtension = 'php';
    
    /** @var PhpClassResolver */
    protected $classResolver;
    
    
    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return (string) $this->fileExtension;
    }
    
    
    /**
     * @param $vendor
     * @param $module
     * @param $class
     *
     * @return PhpClassResolver
     */
    protected function classResolver()
    {
        return $this->classResolver;
    }
}
