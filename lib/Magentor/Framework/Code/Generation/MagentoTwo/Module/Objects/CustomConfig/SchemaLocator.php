<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;
use Magentor\Framework\Exception\ExceptionContainer;
use Nette\PhpGenerator\Constant;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\Property;

class SchemaLocator extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model/Config';
    
    /** @var string */
    protected $configFileSchema = 'config.xsd';
    
    
    /**
     * SchemaLocator constructor.
     *
     * @param string $objectName
     * @param string $module
     * @param string $vendor
     * @param string $configFileSchema
     */
    public function __construct($objectName, $module, $vendor, $configFileSchema = 'config.xsd')
    {
        parent::__construct($objectName, $module, $vendor);
        $this->configFileSchema = $configFileSchema;
    }
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            ExceptionContainer::throwGenericException('Helper already exists. Cannot be created again.');
        }
        
        parent::build();
        
        $template = $this->getTemplate();
        
        $dirClass    = 'Magento\Framework\Module\Dir';
        $readerClass = 'Magento\Framework\Module\Dir\Reader';
        
        $template->addUse($dirClass);
        $template->addUse($readerClass);
        
        /** @var Constant $constant */
        $constant = $template->addConstant('CONFIG_FILE_SCHEMA', $this->configFileSchema);
        $constant->addComment('XML schema for config file.');
        $constant->addComment('@var string');
        
        /** @var Property $property */
        $property = $template->addProperty('schema');
        $property->setVisibility('protected');
        $property->addComment('Path to corresponding XSD file with validation rules for merged config');
        $property->addComment('@var string');
        
        /** @var Property $property */
        $property = $template->addProperty('perFileSchema');
        $property->setVisibility('protected');
        $property->addComment('Path to corresponding XSD file with validation rules for separate config files');
        $property->addComment('@var string');
        
        /** @var Method $method */
        $method = $template->addMethod('__construct');
        $method->addParameter('moduleReader')
            ->setTypeHint($readerClass);
        $method->addComment('@param Reader $moduleReader');
        $method->setBody(<<<PHP
\$configDir = \$moduleReader->getModuleDir(Dir::MODULE_ETC_DIR, 'BitTools_SkyHub');

\$this->schema        = \$configDir . DIRECTORY_SEPARATOR . self::CONFIG_FILE_SCHEMA;
\$this->perFileSchema = \$configDir . DIRECTORY_SEPARATOR . self::CONFIG_FILE_SCHEMA;
PHP
        );
        
        /** @var Method $method */
        $method = $template->addMethod('getSchema');
        $method->addComment('@inheritdoc');
        $method->setBody('return $this->schema;');
        
        /** @var Method $method */
        $method = $template->addMethod('getPerFileSchema');
        $method->addComment('@inheritdoc');
        $method->setBody('return $this->perFileSchema;');
        
        return $this->getTemplate();
    }
    
    
    /**
     * @return array
     */
    protected function getInterfacesClasses()
    {
        return ['Magento\Framework\Config\SchemaLocatorInterface'];
    }
}
