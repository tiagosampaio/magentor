<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig;

use Magentor\Framework\Code\Template\Xml\Config\Acl as AclTemplate;

class AclConfig extends AbstractConfig
{
    
    /** @var string */
    protected $filePath = 'etc';
    
    /** @var string */
    protected $fileName = 'acl';
    
    /** @var string */
    protected $setupVersion;
    
    /** @var array */
    protected $resources = [];
    
    
    /**
     * Module constructor.
     *
     * @param string $module
     * @param string $vendor
     * @param array  $sequences
     */
    public function __construct(string $module, string $vendor, array $resources = [])
    {
        parent::__construct($module, $vendor);
        
        $this->resources = $resources;
    }
    
    
    /**
     * @param string $module
     *
     * @return $this
     */
    public function addResource(string $code, string $title = null, int $sortOrder = 10)
    {
        /** @var AclTemplate $template */
        $template = $this->getTemplate();
        $template->addResource($code, $title, $sortOrder);
        
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    protected function postBuild()
    {
        foreach ((array) $this->resources as $resource) {
            // $this->addResource($sequence);
        }
    }
    
    
    /**
     * @return AclTemplate
     */
    protected function getTemplateInstance()
    {
        return new AclTemplate($this->module, $this->vendor, $this->setupVersion);
    }
}
