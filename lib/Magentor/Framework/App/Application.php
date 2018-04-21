<?php

namespace Magentor\Framework\App;

use Magentor\Framework\File\Locator;
use Magentor\Framework\Component\ModuleRegistrar;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Application as ConsoleApplication;

class Application implements ApplicationInterface
{

    /** @var Locator */
    protected $locator;

    /** @var ConsoleApplication */
    protected $app;

    /** @var self */
    protected static $instance;


    protected function __construct()
    {
        $name    = 'Magentor';
        $version = Version::version();

        $this->app     = new ConsoleApplication($name, $version);
        $this->locator = new Locator();
    }


    /**
     * @return Application
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @return $this
     */
    public function run()
    {
        $this->initMagento();
        $this->initModules();
        $this->initCommands();

        try {
            $this->app->run();
        } catch (\Exception $e) {

        }

        return $this;
    }


    /**
     * @return ConsoleApplication
     */
    public function getConsoleApplication()
    {
        return $this->app;
    }


    /**
     * @return $this|bool
     */
    protected function initModules()
    {
        $modulesFile = DIR_ETC . '/modules.php';

        if (!is_file($modulesFile) && !is_readable($modulesFile)) {
            return false;
        }

        $modules = include_once $modulesFile;

        foreach ($modules as $module) {
            $registrationFile = DIR_CODE . '/' . $module . '/registration.php';

            if (!file_exists($registrationFile) || !is_readable($registrationFile)) {
                continue;
            }

            include_once $registrationFile;
        }

        // $this->locator->loadFiles('registration.php', $this->getCodeDirPattern());
        return $this;
    }


    /**
     * @return $this
     */
    protected function initCommands()
    {
        $modulePaths = ModuleRegistrar::getPaths();

        foreach ($modulePaths as $module => $path) {
            $this->loadCommands('commands.php', $path);
        }

        return $this;
    }
    
    
    /**
     * @return $this
     */
    protected function initMagento()
    {
        $this->getMagentoApp()->bootstrap();
    }
    
    
    /**
     * @return \Magentor\Framework\Magento\ApplicationInterface
     */
    protected function getMagentoApp()
    {
        return \Magentor\Framework\Magento\Application::getInstance();
    }


    /**
     * @param string $filename
     * @param string $path
     *
     * @return $this|bool
     */
    protected function loadCommands($filename, $path)
    {
        $file = $path . '/' . $filename;

        if (!file_exists($file) || !is_readable($file)) {
            return false;
        }

        $commands = (array) include_once $file;

        foreach ($commands as $command) {
            $this->registerCommand($command);
        }

        return $this;
    }


    /**
     * @param string $class
     *
     * @return $this
     */
    protected function registerCommand($class)
    {
        if (!class_exists($class)) {
            return $this;
        }

        /** @var Command $command */
        $command = new $class();
        $this->app->add($command);

        return $this;
    }


    /**
     * @return string
     */
    protected function getCodeDirPattern()
    {
        return DIR_CODE . '/*/*';
    }
}
