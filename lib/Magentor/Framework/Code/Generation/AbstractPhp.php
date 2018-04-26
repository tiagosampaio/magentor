<?php

namespace Magentor\Framework\Code\Generation;

use Magentor\Framework\Code\Resolver\PhpClassResolver;

abstract class AbstractPhp
{
    
    /** @var string */
    protected $fileExtension = 'php';
    
    /** @var PhpClassResolver */
    private $classResolver;
    
    
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
    
    
    /**
     * @param array $parts
     *
     * @return $this
     */
    protected function initResolver(array $parts)
    {
        $this->classResolver = $this->buildResolver($parts);
        return $this;
    }
    
    
    /**
     * @param array $parts
     *
     * @return PhpClassResolver
     */
    protected function buildResolver(array $parts)
    {
        return new PhpClassResolver(implode(BS, $parts));
    }
}
