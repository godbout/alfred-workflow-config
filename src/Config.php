<?php

namespace Godbout\Alfred;

class Config
{
    private static $instance;

    private $workflowDataFolder;


    private function __construct()
    {
        $this->workflowDataFolder = getenv('alfred_workflow_data');
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function load()
    {
        self::getInstance()->createAlfredWorkflowDataFolderIfNeeded();

        self::getInstance()->createConfigFileIfNeeded();
    }

    private function createAlfredWorkflowDataFolderIfNeeded()
    {
        if (! file_exists($this->workflowDataFolder)) {
            mkdir($this->workflowDataFolder);
        }
    }

    private function createConfigFileIfNeeded()
    {
        $configFile = $this->workflowDataFolder . '/config.json';

        if (! file_exists($configFile)) {
            file_put_contents($configFile, json_encode([], JSON_PRETTY_PRINT));
        }
    }
}
