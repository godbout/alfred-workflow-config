<?php

namespace Tests\Feature;

use Tests\TestCase;
use Godbout\Alfred\Config;

class ConfigTest extends TestCase
{
    /** @test */
    public function it_can_save_the_default_configuration_given_by_the_user()
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
