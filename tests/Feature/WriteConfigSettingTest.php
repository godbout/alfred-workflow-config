<?php

namespace Tests\Feature;

use Tests\TestCase;
use Godbout\Alfred\Config;

class WriteConfigSettingTest extends TestCase
{
    /** @test */
    public function it_can_add_a_setting_in_an_empty_config_file()
    {
        Config::write('car', 'renault');

        $this->assertJsonStringEqualsJsonFile($this->configFile, json_encode(['car' => 'renault']));
    }

    /** @test */
    public function it_can_add_a_setting_in_a_non_empty_config_file()
    {
        $defaultConfig = [
            'country' => 'China'
        ];

        Config::ifEmptyStartWith($defaultConfig);

        Config::write('plane', 'airbus');

        $this->assertJsonStringEqualsJsonFile(
            $this->configFile,
            json_encode(array_merge($defaultConfig, ['plane' => 'airbus']))
        );
    }

    /** @test */
    public function it_can_update_a_setting()
    {
        $defaultConfig = [
            'computer' => 'iMac'
        ];

        Config::ifEmptyStartWith($defaultConfig);

        Config::write('computer', 'MacBook');

        $this->assertJsonStringEqualsJsonFile($this->configFile, json_encode(['computer' => 'MacBook']));
    }

    /**
     * iTodo
     *
     * - multidimensional arrays
     */
}
