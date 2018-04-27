<?php

namespace Magentor\Framework\Code\Generation;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Template\Php\PhpClass;

abstract class AbstractPhp
{
    
    /** @var string */
    protected $fileExtension = 'php';
    
    /** @var PhpClassResolver */
    private $classResolver;
    
    
    /**
     * @return PhpClass
     */
    abstract public function build();
    
    
    /**
     * @param $vendor
     * @param $module
     * @param $class
     *
     * @return PhpClassResolver
     */
    public function classResolver()
    {
        return $this->classResolver;
    }
    
    
    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return (string) $this->fileExtension;
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
