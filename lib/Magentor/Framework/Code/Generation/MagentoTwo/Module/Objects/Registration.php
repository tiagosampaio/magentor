<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;
use Magentor\Framework\Code\Template\Php\PhpRawFile;

class Registration extends AbstractModulePhp
{
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpRawFile
     */
    public function build()
    {
        $this->template = new PhpRawFile($this->classResolver());
    
        $body = <<<PHP
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    '{$this->getVendorName()}_{$this->getModuleName()}',
    __DIR__
);
PHP;
        
        $this->template->setBody($body);
        
        return $this->template;
    }
}
