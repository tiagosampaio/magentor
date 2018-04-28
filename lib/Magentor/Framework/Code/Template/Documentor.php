<?php

namespace Magentor\Framework\Code\Template;

use Magentor\Framework\App\Version;

class Documentor
{
    
    /**
     * @return string
     */
    public static function poweredBy()
    {
        $comment = <<<COMMENT
Proudly powered with Magentor CLI!
COMMENT;

        return $comment;
    }
    
    
    /**
     * @return string
     */
    public static function version()
    {
        $version = Version::version();
        $comment = <<<COMMENT
Version v{$version}
COMMENT;
        
        return $comment;
    }
    
    
    /**
     * @return string
     */
    public static function author()
    {
        $comment = <<<COMMENT
@author Tiago Sampaio <tiago@tiagosampaio.com>
COMMENT;
        
        return $comment;
    }
    
    
    /**
     * @return string
     */
    public static function documentBegin()
    {
        $poweredBy = self::poweredBy();
        $version   = self::version();
        $author    = self::author();
        
        $comment = <<<COMMENT
$poweredBy
$version

$author
COMMENT;

        return $comment;
    }
}
