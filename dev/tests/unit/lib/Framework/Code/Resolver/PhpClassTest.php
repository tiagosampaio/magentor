<?php
/**
 * Created by PhpStorm.
 * User: tiagosampaio
 * Date: 26/04/18
 * Time: 10:34
 */

namespace MagentorTest\Framework\Code\Resolver;

use Magentor\Framework\Code\Resolver\PhpClass;
use Magentor\Framework\Code\Resolver\PhpClassInterface;
use PHPUnit\Framework\TestCase;

class PhpClassTest extends TestCase
{

    protected $class          = '\Magentor\ModuleName\Operation\Command\Method\GetModuleCommand';
    protected $classWrong     = 'Magentor\ModuleName/Operation\Command/Method\GetModuleCommand/';
    protected $fileName       = '\Magentor\ModuleName\Operation\Command\Method\GetModuleCommand.php';
    protected $fileNameWithDS = 'Magentor/ModuleName/Operation/Command/Method/GetModuleCommand.php';


    /**
     * @test
     */
    public function resolveInstanceOf()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertInstanceOf(PhpClassInterface::class, $resolver);
    }


    /**
     * @test
     */
    public function resolveModuleVendorName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertEquals('Magentor', $resolver->getVendor());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->classWrong);
        $this->assertEquals('Magentor', $resolver->getVendor());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileName);
        $this->assertEquals('Magentor', $resolver->getVendor());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileNameWithDS);
        $this->assertEquals('Magentor', $resolver->getVendor());
    }


    /**
     * @test
     */
    public function resolveModulePackageName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertEquals('ModuleName', $resolver->getPackage());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->classWrong);
        $this->assertEquals('ModuleName', $resolver->getPackage());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileName);
        $this->assertEquals('ModuleName', $resolver->getPackage());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileNameWithDS);
        $this->assertEquals('ModuleName', $resolver->getPackage());
    }


    /**
     * @test
     */
    public function resolveModuleClassName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertEquals('GetModuleCommand', $resolver->getClassName());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->classWrong);
        $this->assertEquals('GetModuleCommand', $resolver->getClassName());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileName);
        $this->assertEquals('GetModuleCommand', $resolver->getClassName());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileNameWithDS);
        $this->assertEquals('GetModuleCommand', $resolver->getClassName());
    }


    /**
     * @test
     */
    public function resolveModuleFullClassName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertEquals($this->class, $resolver->getFullClassName());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->classWrong);
        $this->assertEquals($this->class, $resolver->getFullClassName());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileName);
        $this->assertEquals($this->class, $resolver->getFullClassName());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileNameWithDS);
        $this->assertEquals($this->class, $resolver->getFullClassName());
    }


    /**
     * @test
     */
    public function resolveModuleClassPath()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertEquals('Operation\Command\Method', $resolver->getClassPath());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->classWrong);
        $this->assertEquals('Operation\Command\Method', $resolver->getClassPath());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileName);
        $this->assertEquals('Operation\Command\Method', $resolver->getClassPath());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileNameWithDS);
        $this->assertEquals('Operation\Command\Method', $resolver->getClassPath());
    }


    /**
     * @test
     */
    public function resolveModuleClassParts()
    {
        $parts = [
            'Magentor',
            'ModuleName',
            'Operation',
            'Command',
            'Method',
            'GetModuleCommand'
        ];

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->class);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->classWrong);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileName);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());

        /** @var PhpClassInterface $resolver */
        $resolver = new PhpClass($this->fileNameWithDS);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());
    }
}
