<?php

namespace Godbout\Alfred;

use ArrayAccess;

class Config implements ArrayAccess
{
    private static $instance;

    private $workflowDataFolder;

    private $configFile;

    private function __construct()
    {
        $this->workflowDataFolder = getenv('alfred_workflow_data');

        $this->configFile = $this->workflowDataFolder . '/config.json';
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function write($key, $value)
    {
        self::getInstance()->initialize();

        $config = json_decode(file_get_contents(self::getInstance()->configFile), true);

        file_put_contents(self::getInstance()->configFile, json_encode(array_merge($config, [$key => $value])));
    }

    public static function read($key)
    {
        self::getInstance()->initialize();

        $config = json_decode(file_get_contents(self::getInstance()->configFile), true);

        return $config[$key] ?? null;
    }

    public static function ifEmptyStartWith(array $defaultConfig = [])
    {
        return self::getInstance()->initialize($defaultConfig);
    }

    private function initialize($defaultConfig = [])
    {
        self::getInstance()->createAlfredWorkflowDataFolderIfNeeded();

        self::getInstance()->createConfigFileIfNeeded($defaultConfig);

        return self::getInstance();
    }

    private function createAlfredWorkflowDataFolderIfNeeded()
    {
        if (! file_exists($this->workflowDataFolder)) {
            mkdir($this->workflowDataFolder);
        }
    }

    private function createConfigFileIfNeeded(array $config)
    {
        if (! file_exists($this->configFile)) {
            file_put_contents($this->configFile, json_encode($config, JSON_PRETTY_PRINT));
        }
    }

    public function offsetExists($offset): bool
    {
        return self::getInstance()->read($offset) !== null;
    }

    public function offsetGet($offset)
    {
        return self::getInstance()->read($offset);
    }

    public function offsetSet($offset, $value): void
    {
        self::getInstance()->write($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        self::getInstance()->write($offset, null);
    }
}
