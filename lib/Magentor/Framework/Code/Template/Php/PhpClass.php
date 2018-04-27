<?php

namespace Magentor\Framework\Code\Template\Php;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;

class PhpClass extends PhpNamespace
{

    /** @var ClassType */
    private $classObject;
    
    /** @var array */
    protected $methods = [];
    
    
    /**
     * @return $this
     */
    public function build()
    {
        parent::build();
        $this->getClass();
        return $this;
    }
    
    
    /**
     * @param string $name
     *
     * @return \Nette\PhpGenerator\Method
     */
    public function addMethod(string $name)
    {
        /** @var \Nette\PhpGenerator\Method $method */
        $method = $this->getClass()->addMethod($name);
        $this->methods[$name] = $method;
        return $method;
    }
    
    
    /**
     * @param string $name
     *
     * @return Method
     */
    public function getMethod(string $name, $createDinamically = true)
    {
        if (!isset($this->methods[$name]) && true === $createDinamically) {
            $this->addMethod($name);
        }
        
        return $this->methods[$name];
    }
    
    
    /**
     * @param string $name
     *
     * @return ClassType|static
     */
    public function addImplement(string $name)
    {
        return $this->getClass()->addImplement($name);
    }
    
    
    /**
     * @param string $name
     *
     * @return ClassType|static
     */
    public function addExtend(string $name)
    {
        return $this->getClass()->addExtend($name);
    }
    
    
    /**
     * @param string $name
     * @param string $value
     *
     * @return \Nette\PhpGenerator\Constant
     */
    public function addConstant(string $name, string $value)
    {
        return $this->getClass()->addConstant($name, $value);
    }
    
    
    /**
     * @param string      $name
     * @param string|null $value
     *
     * @return \Nette\PhpGenerator\Property
     */
    public function addProperty(string $name, string $value = null)
    {
        return $this->getClass()->addProperty($name, $value);
    }
    
    
    /**
     * @param string $comment
     *
     * @return string|self|static
     */
    public function addComment(string $comment)
    {
        return $this->getClass()->addComment($comment);
    }
    
    
    /**
     * @param string $name
     * @param array  $resolutions
     *
     * @return ClassType|static
     */
    public function addTrait(string $name, array $resolutions = [])
    {
        $trait = $this->getClass()->addTrait($name, $resolutions);
        return $trait;
    }
    
    
    /**
     * @return $this
     */
    private function initClass()
    {
        if ($this->classObject) {
            return $this;
        }
        
        $this->classObject = $this->getNamespace()->addClass(
            $this->getClassResolver()->getClassName()
        );
        
        return $this;
    }
    
    
    /**
     * @return ClassType
     */
    protected function getClass()
    {
        $this->initClass();
        return $this->classObject;
    }
}
