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
     * @return $this
     */
    protected function initModules()
    {
        $this->locator->loadFiles('registration.php', $this->getCodeDirPattern());
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
     * @param string $filename
     * @param string $path
     */
    protected function loadCommands($filename, $path)
    {
        $this->locator->name($filename)->in($path);

        /** @var  $file */
        foreach ($this->locator as $file) {
            $commands = (array) include $file->getRealPath();

            foreach ($commands as $command) {
                $this->registerCommand($command);
            }
        }
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
        return CODE_DIR . '/*/*';
    }
}
