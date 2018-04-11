<?php

namespace Magentor\Framework\File;

use Symfony\Component\Finder\Finder;

class Locator
{

    /** @var Finder */
    protected $finder;


    public function __construct()
    {
        $this->finder = new Finder();
    }


    /**
     * @param string $filename
     * @param string $directory
     */
    public function loadFiles($filename, $directory)
    {
        $this->finder->name($filename)->in($directory);

        foreach ($this->finder as $file) {
            if (!is_readable($file->getRealPath())) {
                continue;
            }

            include $file->getRealPath();
        }
    }
}
