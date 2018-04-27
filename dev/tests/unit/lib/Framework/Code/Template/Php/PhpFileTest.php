<?php

namespace MagentorTest\Framework\Code\Template\Php;

use Magentor\Framework\Code\Template\Php\PhpFile;

class PhpFileTest extends PhpAbstract
{
    
    /**
     * @test
     */
    public function emptyPhpFile()
    {
        $expected = <<<PHP
<?php

PHP;
        
        $file = $this->getPhpFile();
        $this->assertEquals($expected, (string) $file);
    }
    
    
    /**
     * @test
     */
    public function commentedPhpFile()
    {
        $comment = 'This is a test comment.';
        $expected = <<<PHP
<?php

/**
 * $comment
 */

PHP;
    
        $file = $this->getPhpFile();
        $file->addComment($comment);
        
        $actual = (string) $file;
        
        $this->assertEquals($expected, $actual);
    }
    
    
    /**
     * @return PhpFile
     */
    protected function getPhpFile()
    {
        return new PhpFile($this->getPhpClassResolver());
    }
}
