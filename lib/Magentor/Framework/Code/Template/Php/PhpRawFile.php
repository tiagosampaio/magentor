<?php

namespace Magentor\Framework\Code\Template\Php;

class PhpRawFile extends PhpAbstract
{
    
    /** @var string */
    protected $vendor;
    
    /** @var string */
    protected $module;
    
    /** @var string */
    protected $body;
    
    
    /**
     * @return $this
     */
    public function build()
    {
        return $this;
    }
    
    
    /**
     * @param string $vendor
     *
     * @return $this
     */
    public function setVendor(string $vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }
    
    
    /**
     * @param string $module
     *
     * @return $this
     */
    public function setModule(string $module)
    {
        $this->module = $module;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->vendor . '_' . $this->module;
    }
    
    
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setBody(string $content)
    {
        $this->body = $content;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    
    /**
     * @return string
     */
    public function __toString()
    {
        $body = <<<PHP
<?php

{$this->getBody()};
PHP;
        
        return $body;
    }
}
