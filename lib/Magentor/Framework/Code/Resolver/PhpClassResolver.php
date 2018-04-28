<?php

namespace Magentor\Framework\Code\Resolver;


class PhpClassResolver implements PhpClassInterface
{

    /** @var string */
    const REFERENCE_STRING = '::class';
    
    /** @var array */
    protected $parts = [];

    /** @var string */
    protected $vendor;

    /** @var string */
    protected $package;

    /** @var string */
    protected $namespace;

    /** @var string */
    protected $className;

    /** @var string */
    protected $classPath;

    /** @var string */
    protected $fullClassName;
    
    /** @var string */
    protected $alias;
    
    
    /**
     * @inheritdoc
     */
    public function __construct(string $class = null, string $alias = null)
    {
        $this->setAlias($alias);
        
        if (!empty($class)) {
            $this->renew($class, $alias);
        }
    }
    
    
    /**
     * @inheritdoc
     */
    public function renew(string $class, string $alias = null)
    {
        $this->setAlias($alias);
        $this->buildParts($class);
        
        return $this;
    }


    /**
     * @return string
     */
    public function getNamespace() : string
    {
        return $this->namespace;
    }


    /**
     * @inheritdoc
     */
    public function getClassName() : string
    {
        return $this->className;
    }


    /**
     * @inheritdoc
     */
    public function getClassNameReference() : string
    {
        return $this->getClassName() . $this->getReferenceString();
    }


    /**
     * @inheritdoc
     */
    public function getAlias() : string
    {
        return (string) $this->alias;
    }


    /**
     * @inheritdoc
     */
    public function getAliasReference() : string
    {
        return $this->getAlias() . $this->getReferenceString();
    }
    
    
    /**
     * @param string|null $alias
     *
     * @return $this
     */
    public function setAlias(string $alias = null)
    {
        if (empty($alias) && $this->getAlias()) {
            return $this;
        }
        
        $this->alias = $this->clearClassString($alias);
        return $this;
    }
    
    
    /**
     * @return $this
     */
    public function unsetAlias()
    {
        $this->alias = null;
        return $this;
    }


    /**
     * @inheritdoc
     */
    public function getClassPath() : string
    {
        return $this->classPath;
    }
    
    
    /**
     * @inheritdoc
     */
    public function getFullClassName(bool $absoluteClass = false, $suffix = null) : string
    {
        $fullClassName = implode(BS, $this->getParts());
        
        if (true === $absoluteClass) {
            $fullClassName = BS . $fullClassName;
        }
        
        if ($suffix) {
            $fullClassName .= $suffix;
        }
        
        return $fullClassName;
    }
    
    
    /**
     * @inheritdoc
     */
    public function getClassReference() : string
    {
        return $this->getFullClassName(false, $this->getReferenceString());
    }
    
    
    /**
     * @inheritdoc
     */
    public function getAbsoluteClassName($suffix = null) : string
    {
        return $this->getFullClassName(true, $suffix);
    }
    
    
    /**
     * @return string
     */
    public function getAbsoluteClassReference() : string
    {
        return $this->getFullClassName(true, $this->getReferenceString());
    }
    
    
    /**
     * @return string
     */
    public function getRelativePath()
    {
        $parts = $this->getParts();
        array_pop($parts);
        
        return implode(DS, $parts);
    }
    
    
    /**
     * @return string
     */
    public function getRelativeFilenamePath()
    {
        return implode(DS, $this->getParts());
    }


    /**
     * @return string
     */
    public function getVendor() : string
    {
        return $this->vendor;
    }


    /**
     * @return string
     */
    public function getPackage() : string
    {
        return $this->package;
    }


    /**
     * @return array
     */
    public function getParts() : array
    {
        $this->buildParts();
        return $this->parts;
    }
    
    
    /**
     * @param string $vendor
     *
     * @return $this
     */
    public function setVendor(string $vendor)
    {
        $this->vendor = $vendor;
        $this->buildParts();
        return $this;
    }
    
    
    /**
     * @param string $package
     *
     * @return $this
     */
    public function setPackage(string $package)
    {
        $this->package = $package;
        $this->buildParts();
        return $this;
    }
    
    
    /**
     * @param string $className
     *
     * @return $this
     */
    public function setClassName(string $className)
    {
        $this->className = $className;
        $this->buildParts();
        return $this;
    }
    
    
    /**
     * @param string|null $class
     * @param string|null $alias
     *
     * @return $this
     */
    protected function rebuild(string $class = null)
    {
        $class = $this->clearClassString($class);
    
        /** @var array $parts */
        $parts = explode(BS, $class);
        
        $this->vendor    = array_shift($parts);
        $this->package   = array_shift($parts);
        $this->className = array_pop($parts);
        
        $this->classPath = $this->joinClass($parts);
        
        $this->namespace = $this->joinClass([
            $this->vendor,
            $this->package,
            $this->classPath
        ]);
        
        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function buildParts(string $class = null)
    {
        if (!empty($class)) {
            $this->rebuild($class);
        }
        
        $fullClass = $this->joinClass([
            $this->vendor,
            $this->package,
            $this->classPath,
            $this->className,
        ]);
        
        $this->parts = [];
    
        foreach (explode(BS, $fullClass) as $part) {
            $part = $this->clearClassString($part);
        
            if (empty($part)) {
                continue;
            }
    
            $this->parts[] = $part;
        }
        
        return $this;
    }


    /**
     * @param string $class
     *
     * @return string
     */
    protected function clearClassString(string $class = null) : string
    {
        $class = str_replace('.php', null, $class);
        $class = trim(trim($class), '/\\');
        $class = str_replace('/', BS, $class);

        return $class;
    }
    
    
    /**
     * @return string
     */
    protected function getReferenceString()
    {
        return self::REFERENCE_STRING;
    }
    
    
    /**
     * @param array $parts
     *
     * @return string
     */
    protected function joinClass(array $parts)
    {
        foreach ($parts as $key => $value) {
            if (!empty($value)) {
                continue;
            }
            
            unset($parts[$key]);
        }
        
        return implode(BS, $parts);
    }
}
