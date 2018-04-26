<?php

namespace MagentorTest\Framework\App;

use Magentor\Framework\App\ApplicationInterface;
use PHPUnit\Framework\TestCase;
use Magentor\Framework\App\Bootstrap;

class ApplicationTest extends TestCase
{

    /**
     * @test
     */
    public function bootstrapInstance()
    {
        $bootstrap = Bootstrap::create(ROOT, $_SERVER);
        $this->assertInstanceOf(Bootstrap::class, $bootstrap);
    }

    /**
     * @test
     */
    public function applicationInstance()
    {
        $bootstrap = Bootstrap::create(ROOT, $_SERVER);
        $this->assertInstanceOf(ApplicationInterface::class, $bootstrap->createApplication());
    }
}
