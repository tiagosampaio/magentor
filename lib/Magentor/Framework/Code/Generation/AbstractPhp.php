<?php
namespace Magentor\Framework\Code\Generation;

abstract class AbstractPhp
{
    
    /** @var int */
    protected $directoryMode = 0755;
    
    /** @var int */
    protected $fileMode = 0644;
    
    /** @var string */
    protected $fileExtension = 'php';
    
    
    /**
     * @return int
     */
    protected function getDirectoryCreationMode()
    {
        return (int) $this->directoryMode;
    }
    
    
    /**
     * @return int
     */
    protected function getFileCreationMode()
    {
        return (int) $this->fileMode;
    }
    
    
    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return (string) $this->fileExtension;
    }
}
