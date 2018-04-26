<?php

namespace Magentor\Framework\Code\Builder;

interface PhpClassBuilderInterface
{
    
    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setNamespace(string $namespace);
    
    
    /**
     * @param string $className
     *
     * @return $this
     */
    public function setClassName(string $className);
    
    
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
    public function addUse(string $class);
    
    
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
        string $body       = null,
        bool   $static     = false,
        bool   $abstract   = false,
        bool   $final      = false
    );
    
    
    /**
     * @return \Nette\PhpGenerator\PhpFile
     */
    public function build();
}
