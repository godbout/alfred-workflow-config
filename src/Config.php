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

    public static function write()
    {
        $defaultConfig = [];

        self::getInstance()->createAlfredWorkflowDataFolderIfNeeded();

        self::getInstance()->createConfigFileIfNeeded($defaultConfig);
    }

    public static function read()
    {
        self::getInstance()->write();
    }

    public static function ifEmptyStartWith(array $defaultConfig = [])
    {
        self::getInstance()->createAlfredWorkflowDataFolderIfNeeded();

        self::getInstance()->createConfigFileIfNeeded($defaultConfig);
    }

    private function createAlfredWorkflowDataFolderIfNeeded()
    {
        if (! file_exists($this->workflowDataFolder)) {
            mkdir($this->workflowDataFolder);
        }
    }

    private function createConfigFileIfNeeded(array $config)
    {
        $configFile = $this->workflowDataFolder . '/config.json';

        if (! file_exists($configFile)) {
            file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT));
        }
    }
}
