<?php

namespace Magentor\Framework\Code\Generation;

use Magentor\Framework\Code\Template\Php\PhpClass;

abstract class AbstractGeneration
{
    
    /** @var string */
    protected $fileExtension = null;
    
    
    /**
     * @return PhpClass
     */
    abstract public function build();
    
    
    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return (string) $this->fileExtension;
    }
}
