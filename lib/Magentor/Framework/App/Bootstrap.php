<?php

namespace Magentor\Framework\App;

class Bootstrap
{

    protected $rootDir;
    protected $initParams;


    /**
     * Bootstrap constructor.
     *
     * @param string $rootDir
     * @param array  $initParams
     */
    public function __construct($rootDir, array $initParams)
    {
        $this->rootDir = $rootDir;
        $this->initParams = $initParams;
    }


    /**
     * @param string $rootDir
     * @param array  $initParams
     *
     * @return Bootstrap
     */
    public static function create($rootDir, array $initParams)
    {
        return new self($rootDir, $initParams);
    }


    /**
     * @return Application
     */
    public function createApplication()
    {
        $application = new Application();
        return $application;
    }
}
