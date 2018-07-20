<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;

class InstallData extends AbstractModulePhp
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

        $migration        = 'Magento\Framework\Module\Setup\Migration';
        $InstallInterface = 'Magento\Framework\Setup\InstallDataInterface';
        $moduleContext    = 'Magento\Framework\Setup\ModuleContextInterface';
        $dataSetup        = 'Magento\Framework\Setup\ModuleDataSetupInterface';
    
        $template->addUse($migration);
        $template->addUse($InstallInterface);
        $template->addUse($moduleContext);
        $template->addUse($dataSetup);
    
        $method = $this->getTemplate()->addMethod('install');
        $method->addParameter('setup')->setTypeHint($dataSetup);
        $method->addParameter('context')->setTypeHint($moduleContext);
    
        $method->addComment('@inheritdoc');

        $body = <<<PHP
\$installer = \$setup;
\$installer->startSetup();

/**
 * Add your logic right here...
 */

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
            "Magento\Framework\Setup\InstallDataInterface"
        ];
    }
}
