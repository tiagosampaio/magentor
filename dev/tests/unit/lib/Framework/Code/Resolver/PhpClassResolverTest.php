<?php
/**
 * Created by PhpStorm.
 * User: tiagosampaio
 * Date: 26/04/18
 * Time: 10:34
 */

namespace MagentorTest\Framework\Code\Resolver;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Resolver\PhpClassInterface;
use PHPUnit\Framework\TestCase;

class PhpClassResolverTest extends TestCase
{

    protected $class          = 'Magentor\ModuleName\Operation\Command\Method\GetModuleCommand';
    protected $classWrong     = '\Magentor\ModuleName/Operation\Command/Method\GetModuleCommand/';
    protected $classNoPath    = 'Magentor\ModuleName/GetModuleCommand/.php';
    protected $fileName       = '\Magentor\ModuleName\Operation\Command\Method\GetModuleCommand.php';
    protected $fileNameWithDS = '\Magentor/ModuleName/Operation/Command/Method/GetModuleCommand.php';


    /**
     * @test
     */
    public function resolveInstanceOf()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = $this->getResolver($this->class);
        $this->assertInstanceOf(PhpClassInterface::class, $resolver);
    }


    /**
     * @test
     */
    public function resolveModuleVendorName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = $this->getResolver($this->class);
        
        $this->assertEquals('Magentor', $resolver->getVendor());
        $this->assertEquals('Magentor', $resolver->renew($this->classWrong)->getVendor());
        $this->assertEquals('Magentor', $resolver->renew($this->classNoPath)->getVendor());
        $this->assertEquals('Magentor', $resolver->renew($this->fileName)->getVendor());
        $this->assertEquals('Magentor', $resolver->renew($this->fileNameWithDS)->getVendor());
    
        $resolver->setVendor('Magentor2');
        $this->assertEquals('Magentor2', $resolver->getVendor());
    }


    /**
     * @test
     */
    public function resolveModulePackageName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = $this->getResolver($this->class);
        
        $this->assertEquals('ModuleName', $resolver->getPackage());
        $this->assertEquals('ModuleName', $resolver->renew($this->classWrong)->getPackage());
        $this->assertEquals('ModuleName', $resolver->renew($this->classNoPath)->getPackage());
        $this->assertEquals('ModuleName', $resolver->renew($this->fileName)->getPackage());
        $this->assertEquals('ModuleName', $resolver->renew($this->fileNameWithDS)->getPackage());
    
        $resolver->setPackage('ModuleName2');
        $this->assertEquals('ModuleName2', $resolver->getPackage());
    }


    /**
     * @test
     */
    public function resolveModuleClassName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = $this->getResolver($this->class);
        
        $this->assertEquals('GetModuleCommand', $resolver->getClassName());
        $this->assertEquals('GetModuleCommand', $resolver->renew($this->classWrong)->getClassName());
        $this->assertEquals('GetModuleCommand', $resolver->renew($this->classNoPath)->getClassName());
        $this->assertEquals('GetModuleCommand', $resolver->renew($this->fileName)->getClassName());
        $this->assertEquals('GetModuleCommand', $resolver->renew($this->fileNameWithDS)->getClassName());
    
        $resolver->setClassName('GetModuleCommand2');
        $this->assertEquals('GetModuleCommand2', $resolver->getClassName());
    }


    /**
     * @test
     */
    public function resolveModuleFullClassName()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = $this->getResolver($this->class);
        
        $this->assertEquals($this->class, $resolver->getFullClassName());
        $this->assertEquals($this->class, $resolver->renew($this->classWrong)->getFullClassName());
        $this->assertEquals('Magentor\ModuleName\GetModuleCommand', $resolver->renew($this->classNoPath)
                                                                             ->getFullClassName());
        $this->assertEquals($this->class, $resolver->renew($this->fileName)->getFullClassName());
        $this->assertEquals($this->class, $resolver->renew($this->fileNameWithDS)->getFullClassName());
    
        $resolver->setVendor('Magentor2');
        $resolver->setPackage('ModuleName2');
        $resolver->setClassName('GetModuleCommand2');
        
        $newClass = 'Magentor2\ModuleName2\Operation\Command\Method\GetModuleCommand2';
        $this->assertEquals($newClass, $resolver->getFullClassName());
    }


    /**
     * @test
     */
    public function resolveModuleClassPath()
    {
        /** @var PhpClassInterface $resolver */
        $resolver = $this->getResolver($this->class);
        
        $this->assertEquals('Operation\Command\Method', $resolver->getClassPath());
        $this->assertEquals('Operation\Command\Method', $resolver->renew($this->classWrong)->getClassPath());
        $this->assertEquals('', $resolver->renew($this->classNoPath)->getClassPath());
        $this->assertEquals('Operation\Command\Method', $resolver->renew($this->fileName)->getClassPath());
        $this->assertEquals('Operation\Command\Method', $resolver->renew($this->fileNameWithDS)->getClassPath());
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
        $resolver = $this->getResolver($this->class);
        
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());
        
        $resolver->renew($this->classWrong);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());
        
        $resolver->renew($this->classNoPath);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals([
            'Magentor',
            'ModuleName',
            'GetModuleCommand'
        ], $resolver->getParts());

        $resolver->renew($this->fileName);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());
        
        $resolver->renew($this->fileNameWithDS);
        $this->assertInternalType('array', $resolver->getParts());
        $this->assertEquals($parts, $resolver->getParts());
    
        /**
         * Lets change some information.
         */
        $resolver->setVendor('Magentor2');
        $resolver->setPackage('ModuleName2');
        $resolver->setClassName('GetModuleCommand2');
        
        $this->assertEquals([
            'Magentor2',
            'ModuleName2',
            'Operation',
            'Command',
            'Method',
            'GetModuleCommand2'
        ], $resolver->getParts());
    }
    
    
    /**
     * @param string|null $class
     *
     * @return PhpClassResolver
     */
    protected function getResolver(string $class = null)
    {
        return new PhpClassResolver($class);
    }
}
