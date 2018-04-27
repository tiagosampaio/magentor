<?php

namespace MagentorTest\Framework\Code\Template\Php;

use Magentor\Framework\Code\Template\Php\PhpFile;
use Magentor\Framework\Code\Template\Php\PhpNamespace;

class PhpNamespaceTest extends PhpAbstract
{
    
    /**
     * @test
     */
    public function emptyPhpNamespaceFile()
    {
        $expected = <<<PHP
<?php
namespace MagentorTest\ModuleTest\PathToClass;

PHP;
        
        $namespace = $this->getNamespace();
        $this->assertEquals($expected, (string) $namespace);
    }
    
    
    /**
     * @return PhpNamespace
     */
    protected function getNamespace()
    {
        return new PhpNamespace($this->getPhpClassResolver());
    }
}
