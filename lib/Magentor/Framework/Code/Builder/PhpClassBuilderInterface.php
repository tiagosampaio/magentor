<?php

namespace Magentor\Framework\Code\Builder;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Template\Php\PhpClass;

interface PhpClassBuilderInterface
{
    
    /**
     * PhpClassBuilderInterface constructor.
     *
     * @param PhpClassResolver $resolver
     */
    public function __construct(PhpClassResolver $resolver);
    
    
    /**
     * @param string $extends
     *
     * @return $this
     */
    public function setExtends(string $extends);
    
    
    /**
     * @param string $class
     *
     * @return $this
     */
    public function addImplements(string $class);
    
    
    /**
     * @param string $class
     *
     * @return $this
     */
    public function addUse(string $class, $alias = null, $aliasOut = null);
    
    
    /**
     * @param string      $name
     * @param string|null $body
     * @param string      $visibility
     * @param bool        $static
     * @param bool        $abstract
     * @param bool        $final
     *
     * @return $this
     */
    public function addMethod(
        string $name,
        string $visibility = 'public',
        string $body = null,
        bool   $static = false,
        bool   $abstract = false,
        bool   $final = false
    );
    
    
    /**
     * @return PhpClass
     */
    public function build();
}
