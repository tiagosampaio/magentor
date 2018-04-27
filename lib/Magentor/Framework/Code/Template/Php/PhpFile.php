<?php

namespace Magentor\Framework\Code\Template\Php;

use Nette\PhpGenerator\PhpFile as PhpGeneratorFile;

class PhpFile extends PhpAbstract
{
    
    /** @var \Nette\PhpGenerator\PhpFile */
    private $phpFile;
    
    
    /**
     * @return PhpGeneratorFile
     */
    public function build()
    {
        $this->initPhpFile();
        return $this->getPhpFile();
    }
    
    
    /**
     * @return $this
     */
    private function initPhpFile()
    {
        $this->phpFile = new PhpGeneratorFile();
        return $this;
    }
    
    
    /**
     * @return PhpGeneratorFile
     */
    protected function getPhpFile()
    {
        return $this->phpFile;
    }
}
