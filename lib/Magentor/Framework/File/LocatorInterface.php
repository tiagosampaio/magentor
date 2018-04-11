<?php

namespace Magentor\Framework\File;

interface LocatorInterface
{

    /**
     * @param string $filename
     * @param string $directory
     */
    public function loadFiles($filename, $directory);
}
