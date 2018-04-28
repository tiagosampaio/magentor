<?php

namespace Magentor\Framework\Code\Generation;

use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\ExceptionContainer;
use Magentor\Framework\Filesystem\Filesystem;

abstract class AbstractGeneration
{
    
    /** @var PhpClass */
    protected $template;
    
    /** @var string */
    protected $fileExtension = null;
    
    
    /**
     * @return PhpClass
     */
    abstract public function build();
    
    
    /**
     * @return string
     */
    abstract public function getFilename();
    
    
    /**
     * @return PhpClass
     */
    public function getTemplate()
    {
        if (!$this->template) {
            $this->build();
        }
        
        return $this->template;
    }
    
    
    /**
     * @return $this
     */
    public function write()
    {
        $filePath = $this->getFilename();
        $content  = (string) $this->getTemplate();
    
        if (file_exists($filePath)) {
            ExceptionContainer::throwFileOverwriteException('File already exists.');
        }
        
        $filesystem = new Filesystem();
        $filesystem->dumpFile($filePath, $content);
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return (string) $this->fileExtension;
    }
}
