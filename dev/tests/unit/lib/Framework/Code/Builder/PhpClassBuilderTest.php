<?php

namespace MagentorTest\Framework\Code\Builder;

use Magentor\Framework\Code\Builder\PhpClassBuilderInterface;
use Magentor\Framework\Code\Resolver\PhpClassResolver;
use PHPUnit\Framework\TestCase;

use Magentor\Framework\Code\Builder\PhpClassBuilder;

class PhpClassBuilderTest extends TestCase
{
    
    protected $class = 'Magentor\Builder\Test\Model\Prepare';
    
    
    /**
     * @test
     */
    public function checkBuilderInstance()
    {
        $builder = $this->getBuilder();
        $this->assertInstanceOf(PhpClassBuilderInterface::class, $builder);
    }
    
    
    /**
     * @return PhpClassBuilderInterface
     */
    protected function getBuilder()
    {
        $resolver = new PhpClassResolver($this->class);
        return new PhpClassBuilder($resolver);
    }
}
