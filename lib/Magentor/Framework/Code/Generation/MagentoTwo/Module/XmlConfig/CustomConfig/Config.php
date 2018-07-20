<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\XmlConfig\AbstractConfig;
use Magentor\Framework\Code\Template\Xml\Config\CustomConfig\Config as CustomConfigTemplate;
use Magentor\Framework\Code\Template\Xml\TemplateFactory;

class Config extends AbstractConfig
{
    
    /** @var string */
    protected $filePath = 'etc';
    
    /** @var string */
    protected $fileName = 'custom_config';
    
    
    /**
     * Module constructor.
     *
     * @param string $module
     * @param string $vendor
     * @param array  $sequences
     */
    public function __construct(string $module, string $vendor, string $configFileName = 'custom_config')
    {
        parent::__construct($module, $vendor);
        $this->fileName = $configFileName;
    }
    
    
    /**
     * @inheritdoc
     */
    protected function postBuild()
    {
    }
    
    
    /**
     * @return CustomConfigTemplate
     */
    protected function getTemplateInstance()
    {
        return TemplateFactory::buildCustomConfigTemplate();
    }
}
