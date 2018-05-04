<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;
use Magentor\Framework\Exception\ExceptionContainer;
use Nette\PhpGenerator\Method;

class Converter extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model/Config';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            ExceptionContainer::throwGenericException('Helper already exists. Cannot be created again.');
        }
        
        parent::build();
    
        $this->prepareDefaultMethods();
        
        return $this->getTemplate();
    }
    
    
    /**
     * @return $this
     */
    protected function prepareDefaultMethods()
    {
        $this->prepareConvertMethod();
        $this->prepareGetAttributeMethod();
        
        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function prepareConvertMethod()
    {
        /**
         * Add Method convert
         * @var Method $method
         */
        $method = $this->getTemplate()->addMethod('convert');
        $method->addParameter('source');
        $method->addComment('@inheritdoc');
        $method->setBody(<<<PHP
    /** @var \DOMXPath \$xpath */
\$xpath = new \DOMXPath(\$source);

/**
 * @var \DOMNodeList \$configNode
 */
\$configNode = \$xpath->evaluate('/config/sample');

\$config = [];

/** @var \DOMElement \$_blacklistNode */
foreach (\$configNode as \$_configNode) {
    \$code = \$this->_getAttributeValue(\$_configNode, 'code');
    \$blacklist[\$code] = \$code;
}

return [
    'config'  => \$config,
    'attributes' => \$attributes
];
PHP
        );
        
        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function prepareGetAttributeMethod()
    {
        /**
         * Add Method _getAttributeValue
         * @var Method $method
         */
        $method = $this->getTemplate()->addMethod('_getAttributeValue');
        $method->setVisibility('protected');
        $method->addParameter('input')
            ->setTypeHint('\DOMNode');
        $method->addParameter('attributeName');
        $method->addParameter('default', null);
        
        $method->setComment(<<<TEXT
Get attribute value

@param \DOMNode    \$input
@param string      \$attributeName
@param string|null \$default

@return null|string
TEXT
        );
        $method->setBody(<<<PHP
\$node = \$input->attributes->getNamedItem(\$attributeName);
return \$node ? \$node->nodeValue : \$default;
PHP
        );
        
        return $this;
    }
    
    
    /**
     * @return array
     */
    protected function getInterfacesClasses()
    {
        return ['Magento\Framework\Config\ConverterInterface'];
    }
}
