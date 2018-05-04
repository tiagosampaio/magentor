<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig\SchemaLocator;
use MagentorTest\Framework\TestCase;

class SchemaLocatorTest extends TestCase
{
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<PHP
<?php
namespace Magentor\CustomConfig\Model\Config;

use Magento\Framework\Config\SchemaLocatorInterface;
use Magento\Framework\Module\Dir;
use Magento\Framework\Module\Dir\Reader;

class SchemaLocator implements SchemaLocatorInterface
{
    /**
     * XML schema for config file.
     * @var string
     */
    const CONFIG_FILE_SCHEMA = 'test.xsd';

    /**
     * Path to corresponding XSD file with validation rules for merged config
     * @var string
     */
    protected \$schema;

    /**
     * Path to corresponding XSD file with validation rules for separate config files
     * @var string
     */
    protected \$perFileSchema;


    /**
     * @param Reader \$moduleReader
     */
    public function __construct(Reader \$moduleReader)
    {
        \$configDir = \$moduleReader->getModuleDir(Dir::MODULE_ETC_DIR, 'BitTools_SkyHub');

        \$this->schema        = \$configDir . DIRECTORY_SEPARATOR . self::CONFIG_FILE_SCHEMA;
        \$this->perFileSchema = \$configDir . DIRECTORY_SEPARATOR . self::CONFIG_FILE_SCHEMA;
    }


    /**
     * @inheritdoc
     */
    public function getSchema()
    {
        return \$this->schema;
    }


    /**
     * @inheritdoc
     */
    public function getPerFileSchema()
    {
        return \$this->perFileSchema;
    }
}

PHP;

        /** @var SchemaLocator $builder */
        $builder  = new SchemaLocator('SchemaLocator', 'CustomConfig', 'Magentor', 'test.xsd');
        $builder->setDirAutoCreation(false);
        $builder->setRenderDoc(false);
        $content = (string) $builder->build();
        
        $this->assertSame($expectedContent, $content);
    }
}
