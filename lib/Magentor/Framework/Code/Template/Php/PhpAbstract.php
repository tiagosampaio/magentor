<?php

namespace Magentor\Framework\Code\Template\Php;

use Magentor\Framework\Code\Resolver\PhpClassResolver;

abstract class PhpAbstract implements PhpInterface
{
    
    /** @var PhpClassResolver */
    protected $classResolver;
    
    
    /**
     * PhpAbstract constructor.
     *
     * @param PhpClassResolver $resolver
     */
    public function __construct(PhpClassResolver $classResolver)
    {
        $this->classResolver = $classResolver;
    }
    
    
    /**
     * @return PhpClassResolver
     */
    protected function getClassResolver()
    {
        return $this->classResolver;
    }
}
