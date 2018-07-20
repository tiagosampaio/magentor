<?php

namespace Magentor\Framework\File;

use Symfony\Component\Finder\Finder;

class Locator extends Finder implements LocatorInterface
{

    /**
     * @param string $filename
     * @param string $directory
     */
    public function loadFiles($filename, $directory)
    {
        $this->name($filename)->in($directory);

        foreach ($this as $file) {
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
        } catch (\Exception $e) {
        }
    }
}
