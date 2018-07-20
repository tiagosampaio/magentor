<?php

namespace Magentor\Framework\Code\Builder;

use Magentor\Framework\Code\Resolver\PhpClassResolver;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Nette\PhpGenerator\Method;

class PhpClassBuilder implements PhpClassBuilderInterface
{
    
    /** @var PhpClassResolver */
    protected $resolver;
    
    protected $extends;
    protected $uses       = [];
    protected $implements = [];
    protected $traits     = [];
    protected $methods    = [];
    
    /** @var bool */
    protected $renderDoc  = true;
    
    
    /**
     * PhpClassBuilder constructor.
     *
     * @param PhpClassResolver $resolver
     */
    public function __construct(PhpClassResolver $resolver, bool $renderDoc = true)
    {
        $this->resolver  = $resolver;
        $this->renderDoc = $renderDoc;
    }
    
    
    /**
     * @inheritdoc
     */
    public function setExtends(string $extends)
    {
        $this->extends = $extends;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function addImplements(string $class)
    {
        $this->implements[$class] = $class;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function addUse(string $class, $alias = null, $aliasOut = null)
    {
        $this->uses[$class] = [
            'class'     => $class,
            'alias'     => $alias,
            'alias_out' => $aliasOut,
        ];
        return $this;
    }
    
    
    /**
     * @param bool $flag
     *
     * @return $this
     */
    public function setRenderDoc(bool $flag = true)
    {
        $this->renderDoc = (bool) $flag;
        return $this;
    }
    
    
    /**
     * @inheritdoc
     */
    public function addMethod(
        string $name,
        string $visibility = 'public',
        string $body = null,
        bool   $static = false,
        bool   $abstract = false,
        bool   $final = false
    ) {
        $this->methods[$name] = [
            'name'       => $name,
            'body'       => $body,
            'visibility' => $visibility,
            'static'     => $static,
            'abstract'   => $abstract,
            'final'      => $final,
        ];
        
        return $this;
    }
    
    
    /**
     * @param string      $name
     * @param string|null $body
     * @param bool        $static
     * @param bool        $abstract
     * @param bool        $final
     *
     * @return $this
     */
    public function addProtectedMethod(
        string $name,
        string $body = null,
        bool   $static = false,
        bool   $abstract = false,
        bool   $final = false
    ) {
        return $this->addMethod($name, 'protected', $body, $static, $abstract, $final);
    }
    
    
    /**
     * @return PhpClass
     */
    public function build()
    {
        /** @var PhpClass $template */
        $template = new PhpClass($this->getResolver(), $this->renderDoc);
        
        $this->buildNamespace($template);
        $this->buildClass($template);
        
        return $template;
    }
    
    
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->build();
    }
    
    
    /**
     * @param PhpClass $template
     *
     * @return $this
     */
    protected function buildNamespace(PhpClass $template)
    {
        foreach ((array) $this->uses as $use) {
            $class = $use['class'];
            $alias = $use['alias'];
            $aliasOut = $use['alias_out'];
            
            $template->getNamespace()->addUse($class, $alias, $aliasOut);
        }
        
        return $this;
    }
    
    
    /**
     * @param PhpClass $template
     *
     * @return $this
     */
    protected function buildClass(PhpClass $template)
    {
        if (!empty($this->extends)) {
            $template->addExtend($this->extends);
        }
    
        foreach ($this->implements as $implement) {
            $template->addImplement((string) $implement);
        }
    
        /** @var string $trait */
        foreach ((array) $this->traits as $trait) {
            $template->addTrait($trait);
        }
    
        /** @var array $method */
        foreach ($this->methods as $methodData) {
            /** @var Method $method */
            $method = $template->addMethod($methodData['name']);
        
            $method->setVisibility($methodData['visibility']);
            $method->setBody($methodData['body']);
            $method->setStatic((bool) $methodData['static']);
            $method->setAbstract((bool) $methodData['abstract']);
            $method->setFinal((bool) $methodData['final']);
        }
        
        return $this;
    }
    
    
    /**
     * @return PhpClassResolver
     */
    protected function getResolver()
    {
        return $this->resolver;
    }
}
