<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig;

use Magentor\Framework\Code\Template\Xml\Config\Module as ModuleTemplate;

class ModuleConfig extends AbstractConfig
{
    
    /** @var string */
    protected $filePath = 'etc';
    
    /** @var string */
    protected $fileName = 'module';
    
    /** @var string */
    protected $setupVersion;
    
    /** @var array */
    protected $sequences = [];
    
    
    /**
     * Module constructor.
     *
     * @param string $module
     * @param string $vendor
     * @param array  $sequences
     */
    public function __construct(string $module, string $vendor, string $setupVersion = null, array $sequences = [])
    {
        parent::__construct($module, $vendor);
        
        $this->setupVersion = $setupVersion;
        $this->sequences    = $sequences;
    }
    
    
    /**
     * @param string $module
     *
     * @return $this
     */
    public function addSequence(string $module)
    {
        /** @var ModuleTemplate $template */
        $template = $this->getTemplate();
        $template->addSequence($module);
        
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    protected function postBuild()
    {
        foreach ((array) $this->sequences as $sequence) {
            $this->addSequence($sequence);
        }
    }
    
    
    /**
     * @return ModuleTemplate
     */
    protected function getTemplateInstance()
    {
        return new ModuleTemplate($this->module, $this->vendor, $this->setupVersion);
    }
}
