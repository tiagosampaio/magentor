<?php

namespace MagentorTest\Framework\Code\Template\Php\XmlConfig;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use PHPUnit\Framework\TestCase;

abstract class XmlConfigAbstract extends TestCase
{
    
    /** @var string */
    protected $module = 'MyModuleTest';
    
    /** @var string */
    protected $vendor = 'MyVendorTest';
    
    /** @var string */
    protected $xsiUrl = 'http://www.w3.org/2001/XMLSchema-instance';
    
    /** @var string */
    protected $schemaLocation = null;
    
    
    /**
     * @return string
     */
    protected function getModuleName()
    {
        return $this->vendor . '_' . $this->module;
    }
}
