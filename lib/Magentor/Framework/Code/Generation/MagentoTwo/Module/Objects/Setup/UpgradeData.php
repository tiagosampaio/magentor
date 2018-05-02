<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;

class UpgradeData extends AbstractModulePhp
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
    
        $setup    = 'Magento\Framework\Setup\ModuleDataSetupInterface';
        $context  = 'Magento\Framework\Setup\ModuleContextInterface';
    
        $template->addUse($setup);
        $template->addUse($context);
        
        $method = $this->getTemplate()->addMethod('upgrade');
        $method->addParameter('setup')->setTypeHint($setup);
        $method->addParameter('context')->setTypeHint($context);
    
        $method->addComment('@inheritdoc');

$body = <<<PHP
\$installer = \$setup;
\$installer->startSetup();

if (version_compare(\$context->getVersion(), '2.0.0', '<')) {
    /**
     * @todo Add your logic right here...
     */
}

if (version_compare(\$context->getVersion(), '2.1.0', '<')) {
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
            "Magento\Framework\Setup\UpgradeDataInterface"
        ];
    }
}
