<?php

namespace Magentor\Framework\Code\Template\Php;

use Magentor\Framework\App\Version;
use Nette\PhpGenerator\Helpers;
use Nette\PhpGenerator\PhpFile as PhpGeneratorFile;

class PhpFile extends PhpAbstract
{
    
    /** @var \Nette\PhpGenerator\PhpFile */
    private $phpFile;
    
    
    /**
     * @return $this
     */
    public function build()
    {
        $this->getPhpFile();
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function __toString()
    {
        return Helpers::tabsToSpaces((string) $this->build()->getPhpFile());
    }
    
    
    /**
     * @param string $comment
     */
    public function addComment(string $comment)
    {
        return $this->getPhpFile()->addComment($comment);
    }
    
    
    /**
     * @return $this
     */
    private function initPhpFile()
    {
        if ($this->phpFile) {
            return $this;
        }
        
        $this->phpFile = new PhpGeneratorFile();
        
        $version = Version::version();
        
        $this->phpFile->addComment('Proudly powered with Magentor CLI!');
        $this->phpFile->addComment("Version v{$version}");
        
        return $this;
    }
    
    
    /**
     * @return PhpGeneratorFile
     */
    public function getPhpFile()
    {
        $this->initPhpFile();
        return $this->phpFile;
    }
}
