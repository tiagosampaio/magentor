<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;

class InstallSchema extends AbstractModulePhp
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
        
        $InstallSchema = 'Magento\Framework\Setup\InstallSchemaInterface';
        $schemaSetup   = 'Magento\Framework\Setup\SchemaSetupInterface';
        $moduleContext = 'Magento\Framework\Setup\ModuleContextInterface';
        $adapter       = 'Magento\Framework\DB\Adapter\AdapterInterface';
    
        $template->addUse($InstallSchema);
        $template->addUse($schemaSetup);
        $template->addUse($moduleContext);
        $template->addUse($adapter);
        
        $method = $this->getTemplate()->addMethod('install');
        $method->addParameter('setup')->setTypeHint($schemaSetup);
        $method->addParameter('context')->setTypeHint($moduleContext);
    
        $method->addComment('@inheritdoc');

$body = <<<PHP
\$installer = \$setup;
\$installer->startSetup();

/**
 * Add your logic right here...
 */
/**
\$table = \$installer->getConnection()->newTable(
    \$installer->getTable('table_name')
)->addColumn(
    'field_id',
    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
    null,
    ['identity' => true, 'nullable' => false, 'primary' => true],
    'Field ID'
)

\$installer->getConnection()->createTable(\$table);

*/

\$installer->endSetup();
PHP;

        $method->setBody($body);
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getInterfacesClasses()
    {
        return [
            "Magento\Framework\Setup\InstallSchemaInterface"
        ];
    }
}
