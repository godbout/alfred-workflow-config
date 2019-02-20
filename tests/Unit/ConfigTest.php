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
    public function the_singleton_is_created_automatically_when_we_load_a_config()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::load();

        $this->assertTrue(true);
    }

    /** @test */
    public function it_saves_the_config_file_in_the_correct_workflow_data_folder()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::load();

        $this->assertFileExists($workflowDataFolder . '/config.json');
    }
}
