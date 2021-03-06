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
Proudly powered by Magentor CLI!
COMMENT;

        return $comment;
    }
    
    
    /**
     * @return string
     */
    public static function githubUrl()
    {
        $comment = <<<COMMENT
Official Repository: http://github.com/tiagosampaio/magentor
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
        $repoUrl   = self::githubUrl();
        $version   = self::version();
        $author    = self::author();
        
        $comment = <<<COMMENT
$poweredBy
$version
$repoUrl

$author
COMMENT;

        return $comment;
    }
}
