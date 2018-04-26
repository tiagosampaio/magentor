<?php

namespace MagentorTest\Framework\Code\Builder;

use Magentor\Framework\Code\Builder\PhpClassBuilderInterface;
use PHPUnit\Framework\TestCase;

use Magentor\Framework\Code\Builder\PhpClassBuilder;

class PhpClassBuilderTest extends TestCase
{
    
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
        return new PhpClassBuilder();
    }
}
