<?php

namespace MagentorTest\Framework\Code\Template\Php;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use PHPUnit\Framework\TestCase;

abstract class PhpAbstract extends TestCase
{
    
    protected $class = 'MagentorTest\ModuleTest\PathToClass\ClassTest';
    
    
    /**
     * @return PhpClassResolver
     */
    protected function getPhpClassResolver()
    {
        return new PhpClassResolver($this->class);
    }
}
