<?php

namespace Magentor\Framework\Code\Template\Php;

use Magentor\Framework\Code\Resolver\PhpClassResolver;

interface PhpInterface
{
    
    /**
     * PhpInterface constructor.
     *
     * @param PhpClassResolver $classResolver
     */
    public function __construct(PhpClassResolver $classResolver);
    
    
    /**
     * @return mixed
     */
    public function build();
}
