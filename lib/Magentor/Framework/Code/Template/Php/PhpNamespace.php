<?php

namespace Magentor\Framework\Code\Template\Php;

use Nette\PhpGenerator\PhpNamespace as GeneratorNamespace;

class PhpNamespace extends PhpFile
{
    
    /** @var GeneratorNamespace */
    private $namespaceObject;
    
    
    /**
     * @return GeneratorNamespace
     */
    public function build()
    {
        parent::build();
        return $this->getNamespace();
    }
    
    
    /**
     * @param string $name
     * @param string $alias
     * @param string $aliasOut
     *
     * @return GeneratorNamespace|static
     */
    public function addUse(string $name, string $alias = null, string &$aliasOut = null)
    {
        $use = $this->getNamespace()->addUse($name, $alias, $aliasOut);
        return $use;
    }
    
    
    /**
     * @param string $name
     *
     * @return \Nette\PhpGenerator\ClassType
     */
    public function addInterface(string $name)
    {
        $interface = $this->getNamespace()->addInterface($name);
        return $interface;
    }
    
    
    /**
     * @return $this
     */
    private function initPhpNamespace()
    {
        $this->namespaceObject = $this->getPhpFile()
                                      ->addNamespace($this->getClassResolver()->getNamespace());
        return $this;
    }
    
    
    /**
     * @return GeneratorNamespace
     */
    protected function getNamespace()
    {
        $this->initPhpNamespace();
        return $this->namespaceObject;
    }
}
