<?php

namespace Magentor\Framework\Code\Template\Php;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Template\TemplateInterface;

interface PhpInterface extends TemplateInterface
{
    
    /**
     * PhpInterface constructor.
     *
     * @param PhpClassResolver $classResolver
     */
    public function __construct(PhpClassResolver $classResolver);
}
