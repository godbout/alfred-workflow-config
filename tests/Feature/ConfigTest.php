<?php

namespace Tests\Feature;

use Godbout\Alfred\Config;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function it_creates_the_workflow_data_folder_at_first_start_if_none_is_found()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::load();

        $this->assertDirectoryExists($workflowDataFolder);
    }

    /** @test */
    public function it_creates_the_config_file_at_first_start_if_none_is_found()
    {
        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';
        putenv("alfred_workflow_data={$workflowDataFolder}");

        Config::load();

        $this->assertFileExists($workflowDataFolder . '/config.json');
    }
}
