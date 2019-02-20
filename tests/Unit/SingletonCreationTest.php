<?php

namespace Tests\Unit;

use Tests\TestCase;
use Godbout\Alfred\Config;

class SingletonCreationTest extends TestCase
{
    /** @test */
    public function it_is_created_automatically_when_we_write_a_config_setting()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::write('fruit', 'tomato');

        $this->assertTrue(true);
    }

    /** @test */
    public function it_is_created_automatically_when_we_read_a_config_setting()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::read('vegetable');

        $this->assertTrue(true);
    }

    /** @test */
    public function it_is_created_automatically_when_the_user_asks_for_creating_the_config_with_default_settings()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::ifEmptyStartWith([]);

        $this->assertTrue(true);
    }
}
