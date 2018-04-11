<?php

namespace Magentor\Framework\App;

use Magentor\Framework\File\Locator;

class Application implements ApplicationInterface
{

    /** @var Locator */
    protected $locator;


    public function __construct()
    {
        $this->locator = new Locator();;
    }


    public function run()
    {
        $this->initModules();
        $this->initCommands();
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
        $this->locator->loadFiles('commands.php', $this->getCodeDirPattern());
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
