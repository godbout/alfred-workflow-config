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

    /** @test */
    public function it_returns_the_instance_when_the_user_asks_for_creating_the_config_with_default_settings()
    {
        $this->assertSame(Config::ifEmptyStartWith([]), Config::getInstance());
    }
}
