<?php

namespace Tests\Feature;

use Tests\TestCase;
use Godbout\Alfred\Config;

class WorkflowDataFolderCreationTest extends TestCase
{
    public function setUp(): void
    {
        $this->workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';

        putenv("alfred_workflow_data={$this->workflowDataFolder}");
    }

    /** @test */
    public function it_creates_the_folder_if_it_doesnt_exist_when_writing_a_config_setting()
    {
        Config::write('something', 3);

        $this->assertDirectoryExists($this->workflowDataFolder);
    }

    /** @test */
    public function it_creates_the_folder_if_it_doesnt_exist_when_reading_a_config_setting()
    {
        Config::read('something');

        $this->assertDirectoryExists($this->workflowDataFolder);
    }

    /** @test */
    public function it_creates_the_folder_if_it_doesnt_exist_when_the_user_asks_for_creating_the_config_with_default_settings()
    {
        Config::ifEmptyStartWith(['some setting' => false]);

        $this->assertDirectoryExists($this->workflowDataFolder);
    }
}
