<?php

namespace Magentor\Framework\Code\Template\Php;

use Magentor\Framework\Code\Resolver\PhpClassResolver;

abstract class PhpAbstract implements PhpInterface
{
    
    /** @var PhpClassResolver */
    protected $classResolver;
    
    /** @var bool */
    protected $renderDoc;
    
    
    /**
     * PhpAbstract constructor.
     *
     * @param PhpClassResolver $resolver
     */
    public function __construct(PhpClassResolver $classResolver, bool $renderDoc = true)
    {
        $this->classResolver = $classResolver;
        $this->renderDoc     = $renderDoc;
    }
    
    
    /**
     * @return PhpClassResolver
     */
    public function resolver()
    {
        return $this->classResolver;
    }
}
