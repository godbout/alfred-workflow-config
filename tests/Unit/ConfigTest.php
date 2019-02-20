<?php

namespace Tests\Unit;

use Godbout\Alfred\Config;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function it_is_a_singleton()
    {
        $this->assertSame(Config::getInstance(), Config::getInstance());
    }
}
