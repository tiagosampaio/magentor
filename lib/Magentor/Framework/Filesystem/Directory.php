<?php

namespace Magentor\Framework\Filesystem;

class Directory
{
    
    /** @var int */
    const MODE_DIRECTORY = 0755;
    
    
    /**
     * @param string $dirname
     * @param string $mode
     * @param string $recursive
     *
     * @return bool
     */
    public static function mkDir($dirname, $mode = self::MODE_DIRECTORY, $recursive = true)
    {
        if (is_dir($dirname)) {
            return true;
        }
        
        return mkdir($dirname, $mode, $recursive);
    }
}
