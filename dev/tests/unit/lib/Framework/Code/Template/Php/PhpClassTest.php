<?php

namespace MagentorTest\Framework\Code\Template\Php;

use Magentor\Framework\Code\Template\Php\PhpClass;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\Parameter;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Property;

class PhpClassTest extends PhpAbstract
{
    
    protected $namespace      = 'MagentorTest\ModuleTest\PathToClass';
    protected $abstractClass  = "Magentor\Framework\AbstractClass";
    protected $interfaceClass = "Magentor\Framework\AbstractInterface";
    
    
    /**
     * @test
     */
    public function involvedInstanceTypes()
    {
        $class = $this->getClass();
        $this->assertInstanceOf(PhpClass::class, $class);
        
        $extend = $class->addExtend($this->abstractClass);
        $this->assertInstanceOf(ClassType::class, $extend);
        
        $method = $class->addMethod('test');
        $this->assertInstanceOf(Method::class, $method);
    
        $namespace = $class->getNamespace();
        $this->assertInstanceOf(PhpNamespace::class, $namespace);
    }
    
    
    /**
     * @test
     */
    public function defaultPhpClass()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

class ClassTest
{
}

PHP;
        
        $class = $this->getClass();
        $this->assertEquals($expected, (string) $class);
    }
    
    
    /**
     * @test
     */
    public function defaultPhpClassWithExtendsFullClass()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

class ClassTest extends \\$this->abstractClass
{
}

PHP;
        
        $class  = $this->getClass();
        $class->addExtend($this->abstractClass);
        
        $this->assertEquals($expected, (string) $class);
    }
    
    
    /**
     * @test
     */
    public function defaultPhpClassWithExtendsImportingClass()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

use Magentor\Framework\AbstractClass;

class ClassTest extends AbstractClass
{
}

PHP;
        
        $class = $this->getClass();
        $class->getNamespace()->addUse($this->abstractClass);
        $class->addExtend($this->abstractClass);
        
        $this->assertEquals($expected, (string) $class);
    }
    
    
    /**
     * @test
     */
    public function defaultPhpClassWithExtendsImportingClassAndImplementingFullInterface()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

use $this->abstractClass;

class ClassTest extends AbstractClass implements \\$this->interfaceClass
{
}

PHP;
        
        $class = $this->getClass();
        $class->getNamespace()->addUse($this->abstractClass);
        $class->addExtend($this->abstractClass);
        $class->addImplement($this->interfaceClass);
        
        $this->assertEquals($expected, (string) $class);
    }
    
    
    /**
     * @test
     */
    public function defaultPhpClassWithExtendsAndImplementsImportingClassAndInterface()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

use $this->abstractClass;
use $this->interfaceClass;

class ClassTest extends AbstractClass implements AbstractInterface
{
}

PHP;
        
        $class = $this->getClass();
        $class->getNamespace()->addUse($this->abstractClass);
        $class->getNamespace()->addUse($this->interfaceClass);
        $class->addExtend($this->abstractClass);
        $class->addImplement($this->interfaceClass);
        
        $this->assertEquals($expected, (string) $class);
    }
    
    
    /**
     * @test
     */
    public function defaultPhpClassWithMethod()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

use $this->abstractClass;
use $this->interfaceClass;
use ObjectInterface;

class ClassTest extends AbstractClass implements AbstractInterface
{
    /** @var ObjectInterface */
    protected \$interface;


    final protected static function setInterface(ObjectInterface \$interface = null)
    {
        \$this->interface = \$interface;
        return \$this;
    }
}

PHP;
        
        /** @var ClassType $class */
        $class = $this->getClass();
        
        $class->getNamespace()->addUse($this->abstractClass);
        $class->getNamespace()->addUse($this->interfaceClass);
        $class->getNamespace()->addUse('ObjectInterface');
        
        $class->addExtend($this->abstractClass);
        $class->addImplement($this->interfaceClass);
        
        $property = $class->addProperty('interface', null);
    
        $this->assertInstanceOf(Property::class, $property);
        
        $property->setVisibility('protected');
        $property->setComment("@var ObjectInterface");
        
        /** @var Method $method */
        $method = $class->addMethod('setInterface');
        
        $method->setStatic(true);
        $method->setFinal(true);
        $method->setVisibility('protected');
        
        /** @var Parameter $parameter */
        $parameter = $method->addParameter('interface', null);
        $parameter->setTypeHint('ObjectInterface');
        
        $method->addBody('$this->interface = $interface;');
        $method->addBody('return $this;');
        
        $this->assertEquals($expected, (string) $class);
    }
    
    
    /**
     * @return PhpClass
     */
    protected function getClass()
    {
        return new PhpClass($this->getPhpClassResolver(), false);
    }
}
