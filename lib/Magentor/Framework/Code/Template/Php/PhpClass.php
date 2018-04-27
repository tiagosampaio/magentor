<?php

namespace Magentor\Framework\Code\Template\Php;

use Nette\PhpGenerator\ClassType;

class PhpClass extends PhpNamespace
{

    /** @var ClassType */
    private $classObject;
    
    
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
        return $method;
    }
    
    
    /**
     * @param string $name
     *
     * @return ClassType|static
     */
    public function addImplement(string $name)
    {
        $implement = $this->getClass()->addImplement($name);
        return $implement;
    }
    
    
    /**
     * @param string $name
     *
     * @return ClassType|static
     */
    public function addExtend(string $name)
    {
        $extend = $this->getClass()->addExtend($name);
        return $extend;
    }
    
    
    /**
     * @param string $name
     * @param string $value
     *
     * @return \Nette\PhpGenerator\Constant
     */
    public function addConstant(string $name, string $value)
    {
        $constant = $this->getClass()->addConstant($name, $value);
        return $constant;
    }
    
    
    /**
     * @param string      $name
     * @param string|null $value
     *
     * @return \Nette\PhpGenerator\Property
     */
    public function addProperty(string $name, string $value = null)
    {
        $property = $this->getClass()->addProperty($name, $value);
        return $property;
    }
    
    
    /**
     * @param string $comment
     *
     * @return string|self|static
     */
    public function addComment(string $comment)
    {
        $comment = $this->getClass()->addComment($comment);
        return $comment;
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
