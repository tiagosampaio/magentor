<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;

class UpgradeSchema extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Setup';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        parent::build();
        $this->buildDefaultMethods();
        return $this->getTemplate();
    }
    
    
    /**
     * @return $this
     */
    public function buildDefaultMethods()
    {
        $template = $this->getTemplate();
        
        $upgradeSchema = 'Magento\Framework\Setup\UpgradeSchemaInterface';
        $schemaSetup   = 'Magento\Framework\Setup\SchemaSetupInterface';
        $moduleContext = 'Magento\Framework\Setup\ModuleContextInterface';
        $adapter       = 'Magento\Framework\DB\Adapter\AdapterInterface';
    
        $template->addUse($upgradeSchema);
        $template->addUse($schemaSetup);
        $template->addUse($moduleContext);
        $template->addUse($adapter);
        
        $method = $this->getTemplate()->addMethod('upgrade');
        $method->addParameter('setup')->setTypeHint($schemaSetup);
        $method->addParameter('context')->setTypeHint($moduleContext);
    
        $method->addComment('@inheritdoc');

        $body = <<<PHP
\$installer = \$setup;
\$installer->startSetup();

if (version_compare(\$context->getVersion(), '2.0.0', '<')) {
    /**
     * @todo Add your logic right here...
     */
}

\$installer->endSetup();
PHP;

        $method->setBody($body);
        
        return $this;
    }
    
    
    /**
     * @return array
     */
    protected function getInterfacesClasses()
    {
        return [
            "Magento\Framework\Setup\UpgradeSchemaInterface"
        ];
    }
}
