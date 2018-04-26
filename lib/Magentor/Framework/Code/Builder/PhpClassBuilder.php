<?php

namespace Magentor\Framework\Code\Builder;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Helpers;

class PhpClassBuilder implements PhpClassBuilderInterface
{
    
    protected $namespace;
    protected $className;
    protected $extends;
    protected $uses       = [];
    protected $implements = [];
    protected $traits     = [];
    protected $methods    = [];
    
    /** @var PhpNamespace */
    protected $namespaceObject;
    
    /** @var ClassType */
    protected $classObject;
    
    
    /**
     * @inheritdoc
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function setClassName(string $className)
    {
        $this->className = $className;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function setExtends(string $extends)
    {
        $this->extends = $extends;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function addImplements(string $class)
    {
        $this->implements[$class] = $class;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function addUse(string $class)
    {
        $this->uses[$class] = $class;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function addMethod(
        string $name,
        string $visibility = 'public',
        string $body       = null,
        bool   $static     = false,
        bool   $abstract   = false,
        bool   $final      = false
    )
    {
        $this->methods[$name] = [
            'name'       => $name,
            'body'       => $body,
            'visibility' => $visibility,
            'static'     => $static,
            'abstract'   => $abstract,
            'final'      => $final,
        ];
        
        return $this;
    }
    
    
    /**
     * @param string      $name
     * @param string|null $body
     * @param bool        $static
     * @param bool        $abstract
     * @param bool        $final
     *
     * @return $this
     */
    public function addProtectedMethod(
        string $name,
        string $body     = null,
        bool   $static   = false,
        bool   $abstract = false,
        bool   $final    = false
    )
    {
        return $this->addMethod($name, 'protected', $body, $static, $abstract, $final);
    }
    
    
    /**
     * @return PhpFile
     */
    public function build()
    {
        return $this->buildFile();
    }
    
    
    /**
     * @return PhpNamespace
     */
    public function getNamespaceObject()
    {
        $this->build();
        return $this->namespaceObject;
    }
    
    
    /**
     * @return ClassType
     */
    public function getClassObject()
    {
        $this->build();
        return $this->classObject;
    }
    
    
    /**
     * @return string
     */
    public function __toString()
    {
        return Helpers::tabsToSpaces((string) $this->build());
    }
    
    
    /**
     * @return PhpFile
     */
    protected function buildFile()
    {
        $file = new PhpFile();
        $this->buildNamespace($file);
        
        return $file;
    }
    
    
    /**
     * @param PhpFile $file
     *
     * @return $this
     */
    protected function buildNamespace(PhpFile $file)
    {
        $this->namespaceObject = $file->addNamespace($this->namespace);
        
        $this->buildNamespaceUses($this->namespaceObject);
        $this->buildClass($this->namespaceObject);
        
        return $this;
    }
    
    
    /**
     * @param PhpNamespace $namespace
     *
     * @return $this
     */
    protected function buildNamespaceUses(PhpNamespace $namespace)
    {
        foreach ((array) $this->uses as $use) {
            $namespace->addUse($use);
        }
        
        return $this;
    }
    
    
    /**
     * @param PhpNamespace $namespace
     *
     * @return $this
     */
    protected function buildClass(PhpNamespace $namespace)
    {
        /** @var ClassType $class */
        $this->classObject = $namespace->addClass($this->className);
        
        $this->buildClassExtends($this->classObject);
        $this->buildClassImplements($this->classObject);
        $this->buildClassTraits($this->classObject);
        $this->buildClassMethods($this->classObject);
        
        return $this;
    }
    
    
    /**
     * @param ClassType $class
     *
     * @return $this
     */
    protected function buildClassExtends(ClassType $class)
    {
        $class->addExtend($this->extends);
        return $this;
    }
    
    
    /**
     * @param ClassType $class
     *
     * @return $this
     */
    protected function buildClassImplements(ClassType $class)
    {
        foreach ($this->implements as $implement) {
            $class->addImplement((string) $implement);
        }
        
        return $this;
    }
    
    
    /**
     * @param ClassType $class
     *
     * @return $this
     */
    protected function buildClassTraits(ClassType $class)
    {
        /** @var string $trait */
        foreach ((array) $this->traits as $trait) {
            $class->addTrait($trait);
        }
        
        return $this;
    }
    
    
    /**
     * @param ClassType $class
     *
     * @return $this
     */
    protected function buildClassMethods(ClassType $class)
    {
        /** @var array $method */
        foreach ($this->methods as $methodData) {
            /** @var Method $method */
            $method = $class->addMethod($methodData['name']);
            
            $method->setVisibility($methodData['visibility']);
            $method->setBody($methodData['body']);
            $method->setStatic((bool) $methodData['static']);
            $method->setAbstract((bool) $methodData['abstract']);
            $method->setFinal((bool) $methodData['final']);
        }
        
        return $this;
    }
}
