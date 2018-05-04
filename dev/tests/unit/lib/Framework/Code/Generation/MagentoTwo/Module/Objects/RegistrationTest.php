<?php

namespace MagentorTest\Framework\Code\Generation\MagentoTwo\Module\Objects\Model;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Registration;
use MagentorTest\Framework\TestCase;

class RegistrationTest extends TestCase
{
    
    /**
     * @test
     */
    public function validateOutput()
    {
        $expectedContent = <<<PHP
<?php

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Magentor_RegistrationTest',
    __DIR__
);
PHP;

        /** @var Registration $builder */
        $builder  = new Registration('registration', 'RegistrationTest', 'Magentor');
        $builder->setDirAutoCreation(false);
        $builder->setRenderDoc(false);
        $content = (string) $builder->build();
        
        $this->assertSame($expectedContent, $content);
    }
}
