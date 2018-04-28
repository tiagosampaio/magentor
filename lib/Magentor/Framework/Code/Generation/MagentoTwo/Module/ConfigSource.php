<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\Container;
use Nette\PhpGenerator\Method;

class ConfigSource extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model/System/Config/Source';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('System config source already exists. Cannot be created again.');
        }
    
        parent::build();
        
        $this->buildMethods();
        
        return $this->getTemplate();
    }
    
    
    /**
     * @return $this
     */
    protected function buildMethods()
    {
        $toOptionArrayBody = <<<PHP
\$options = [];

foreach ((array) \$this->toArray() as \$value => \$label) {
    \$options[] = [
        'value' => \$value,
        'label' => \$label,
    ];
}

return \$options;
PHP;
        
        $this->getTemplate()
             ->addMethod('toOptionArray')
             ->setVisibility('public')
             ->addBody($toOptionArrayBody)
             ->addComment("Options getter\n")
             ->addComment('@return array');
        
        $toArrayBody = <<<PHP
return [
    0 => __('Option One'),
    1 => __('Option Two'),
];
PHP;

        $this->getTemplate()
             ->addMethod('toArray')
             ->setVisibility('public')
             ->addBody($toArrayBody)
             ->addComment("Get options in \"key-value\" format\n")
             ->addComment('@return array');
        
        return $this;
    }
    
    
    protected function getInterfacesClasses()
    {
        return [
            'Magento\Framework\Option\ArrayInterface'
        ];
    }
}
