<?php

namespace Tests;

use Godbout\Alfred\Config;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;

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

        $this->resetConfigSingletion();

        $workflowDataFolder = './tests/mo.com.sleeplessmind.alfred-workflow-config';

        if (file_exists($workflowDataFolder . '/config.json')) {
            unlink($workflowDataFolder . '/config.json');
        }

        if (file_exists($workflowDataFolder)) {
            rmdir($workflowDataFolder);
        }
    }

    private function resetConfigSingletion()
    {
        $config = Config::getInstance();
        $reflection = new ReflectionClass($config);
        $instance = $reflection->getProperty('instance');
        $instance->setAccessible(true);
        $instance->setValue(null, null);
        $instance->setAccessible(false);
    }
}
