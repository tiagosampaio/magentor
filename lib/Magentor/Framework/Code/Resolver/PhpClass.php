<?php
/**
 * Created by PhpStorm.
 * User: tiagosampaio
 * Date: 26/04/18
 * Time: 10:30
 */

namespace Magentor\Framework\Code\Resolver;


class PhpClass implements PhpClassInterface
{

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


    /**
     * PhpClassInterface constructor.
     *
     * @param string $class
     * @param string $type
     */
    public function __construct(string $class, string $type = self::TYPE_MODULE)
    {
        $this->fullClassName = $class;
        $this->resolve();
    }


    /**
     * @return string
     */
    public function getNamespace() : string
    {
        return $this->namespace;
    }


    /**
     * @return string
     */
    public function getClassName() : string
    {
        return $this->className;
    }


    /**
     * @return string
     */
    public function getClassPath() : string
    {
        return $this->classPath;
    }


    /**
     * @return string
     */
    public function getFullClassName() : string
    {
        return BS . $this->fullClassName;
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
        return $this->parts;
    }


    /**
     * @return $this
     */
    protected function resolve()
    {
        $this->fullClassName = $this->clearClassString($this->fullClassName);
        $this->parts         = explode(BS, $this->fullClassName);

        $parts = $this->parts;

        $this->className = array_pop($parts);
        $this->vendor    = array_shift($parts);
        $this->package   = array_shift($parts);
        $this->classPath = implode(BS, $parts);

        return $this;
    }


    /**
     * @param string $class
     *
     * @return string
     */
    protected function clearClassString(string $class) : string
    {
        $class = trim(trim($class), '/\\');
        $class = str_replace('/', BS, $class);
        $class = str_replace('.php', null, $class);

        return $class;
    }
}
