<?php

namespace Tests\Feature;

use Tests\TestCase;
use Godbout\Alfred\Config;

class ConfigFileCreationTest extends TestCase
{
    public function setUp(): void
    {
        $this->configFile = './tests/mo.com.sleeplessmind.alfred-workflow-config/config.json';

        putenv("alfred_workflow_data=./tests/mo.com.sleeplessmind.alfred-workflow-config");
    }

    /** @test */
    public function it_creates_the_file_if_it_doesnt_exist_when_writing_a_config_setting()
    {
        Config::write('something', 3);

        $this->assertFileExists($this->configFile);
    }

    /** @test */
    public function it_creates_the_file_if_it_doesnt_exist_when_reading_a_config_setting()
    {
        Config::read('another thing');

        $this->assertFileExists($this->configFile);
    }

    /** @test */
    public function it_creates_the_file_if_it_doesnt_exist_when_the_user_asks_for_creating_the_config_with_default_settings()
    {
        $defaultConfig = [
            'version' => 1.4,
            'address' => [
                'country' => 'France',
                'city' => 'Nancy',
            ],
            'author' => [
                'name' => 'Guill',
                'age' => 37,
                'alive' => true,
            ],
            'language' => 'french, english, portuguese, cantonese'
        ];

        Config::ifEmptyStartWith($defaultConfig);

        $this->assertJsonStringEqualsJsonFile($this->configFile, json_encode($defaultConfig));
    }
}
