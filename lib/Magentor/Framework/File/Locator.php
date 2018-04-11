<?php

namespace Magentor\Framework\File;

use Symfony\Component\Finder\Finder;

class Locator implements LocatorInterface
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
            $this->includeFile($file->getRealPath());
        }
    }


    /**
     * @param string $filePath
     */
    protected function includeFile($filePath)
    {
        try {
            if (!is_readable($filePath)) {
                return;
            }

            include $filePath;
        } catch (\Exception $e) {}
    }
}
