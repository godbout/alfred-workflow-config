<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';

        $this->configFile = $this->workflowDataFolder . '/config.json';

        putenv("alfred_workflow_data={$this->workflowDataFolder}");
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';

        if (file_exists($workflowDataFolder . '/config.json')) {
            unlink($workflowDataFolder . '/config.json');
        }

        if (file_exists($workflowDataFolder)) {
            rmdir($workflowDataFolder);
        }
    }
}
