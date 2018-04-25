<?php

namespace Magentor\Framework\Filesystem;

class Io
{
    
    /** @var int */
    const MODE_DIRECTORY = 0755;
    
    /** @var int */
    const MODE_FILE      = 0644;
    
    
    /**
     * @param string $filename
     * @param string $contents
     *
     * @return $this
     */
    public function write($filename, $contents = '')
    {
        @file_put_contents($filename, $contents);
        return $this;
    }
}
