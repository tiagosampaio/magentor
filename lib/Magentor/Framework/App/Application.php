<?php

namespace Magentor\Framework\App;

use Magentor\Framework\File\Locator;

class Application implements ApplicationInterface
{

    public function run()
    {
        $this->initModules();
        echo "Application Initialized.\n";
    }


    /**
     * @return $this
     */
    protected function initModules()
    {
        $dir = ROOT . '/app/code/*/*';

        $locator = new Locator();
        $locator->loadFiles('registration.php', $dir);

        return $this;
    }
}
