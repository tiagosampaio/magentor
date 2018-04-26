<?php

namespace Magentor\Framework\Code\Generation;

abstract class AbstractPhp
{
    
    /** @var string */
    protected $fileExtension = 'php';
    
    
    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return (string) $this->fileExtension;
    }
}
