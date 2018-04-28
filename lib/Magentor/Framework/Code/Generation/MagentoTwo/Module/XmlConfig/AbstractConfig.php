<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig;

use Magentor\Framework\Code\Generation\AbstractGeneration;
use Magentor\Framework\Code\Template\Xml\XmlAbstract;
use Magentor\Framework\Filesystem\DirectoryRegistrar;

abstract class AbstractConfig extends AbstractGeneration
{
    
    /** @var string */
    protected $module;
    
    /** @var string */
    protected $vendor;
    
    /** @var string */
    protected $filePath = null;
    
    /** @var string */
    protected $fileName = null;
    
    /** @var string */
    protected $fileExtension = 'xml';
    
    /** @var XmlAbstract */
    protected $template;
    
    
    /**
     * AbstractConfig constructor.
     *
     * @param string $module
     * @param string $vendor
     */
    public function __construct(string $module, string $vendor)
    {
        $this->module = $module;
        $this->vendor = $vendor;
    }
    
    
    /***
     * @return XmlAbstract
     */
    public function getTemplate()
    {
        $this->initTemplate();
        return $this->template;
    }
    
    
    /**
     * @return XmlAbstract
     */
    public function build()
    {
        /** @var XmlAbstract $template */
        $template = $this->getTemplate();
        $template->build();
        
        $this->postBuild();
        
        return $template;
    }
    
    
    /**
     * @return void
     */
    abstract protected function postBuild();
    
    
    /**
     * @return XmlAbstract
     */
    abstract protected function getTemplateInstance();
    
    
    /**
     * @return string
     */
    public function getFilename()
    {
        $path  = DirectoryRegistrar::magentoBuildModulePath($this->vendor, $this->module) . DS;
        $path .= $this->filePath . DS;
        $path .= $this->fileName . '.' . $this->getFileExtension();
        
        return $path;
    }
    
    
    /**
     * @return $this
     */
    protected function initTemplate()
    {
        if (is_null($this->template)) {
            $this->template = $this->getTemplateInstance();
        }
        
        return $this;
    }
}