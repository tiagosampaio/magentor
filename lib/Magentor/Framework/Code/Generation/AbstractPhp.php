<?php

namespace Magentor\Framework\Code\Generation;

use Magentor\Framework\Code\Resolver\PhpClassResolver;

abstract class AbstractPhp extends AbstractGeneration
{
    
    /** @var string */
    protected $fileExtension = 'php';
    
    /** @var PhpClassResolver */
    private $classResolver;
    
    
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
