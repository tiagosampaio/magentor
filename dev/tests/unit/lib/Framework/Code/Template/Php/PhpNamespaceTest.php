<?php

namespace MagentorTest\Framework\Code\Template\Php;

use Magentor\Framework\Code\Template\Php\PhpNamespace;

class PhpNamespaceTest extends PhpAbstract
{
    
    protected $namespace = 'MagentorTest\ModuleTest\PathToClass';
    
    
    /**
     * @test
     */
    public function defaultPhpNamespaceContent()
    {
        $expected = <<<PHP
<?php
namespace $this->namespace;

PHP;
        
        $namespace = $this->getNamespace();
        $this->assertEquals($expected, (string) $namespace);
    }
    
    
    /**
     * @test
     */
    public function phpNamespaceContentWithTwoUses()
    {
        $useOne = 'Magentor\MyModule\MyPath\MyClassFileOne';
        $useTwo = 'Magentor\MyModule\MyPath\MyClassFileTwo';
        
        $expected = <<<PHP
<?php
namespace $this->namespace;

use $useOne;
use $useTwo;

PHP;
        
        $namespace = $this->getNamespace();
        $namespace->addUse($useOne);
        $namespace->addUse($useTwo);
        
        $this->assertEquals($expected, (string) $namespace);
    }
    
    
    /**
     * @return PhpNamespace
     */
    protected function getNamespace()
    {
        return new PhpNamespace($this->getPhpClassResolver(), false);
    }
}
