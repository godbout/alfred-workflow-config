<?php

namespace Tests\Feature;

use Tests\TestCase;
use Godbout\Alfred\Config;

class ConfigArrayAccessTest extends TestCase
{
    /** @test */
    public function it_is_possible_to_check_whether_a_setting_is_not_set_or_empty_by_using_vanilla_php_functions()
    {
        $config = Config::ifEmptyStartWith([]);

        $this->assertTrue(empty($config['wrong index']));
        $this->assertFalse(isset($config['wrong again']));
    }
    /** @test */
    public function it_is_possible_to_read_a_setting_using_an_array_syntax()
    {
        $config = Config::ifEmptyStartWith(['language' => 'cantonese']);

        $this->assertSame($config['language'], 'cantonese');
    }

    /** @test */
    public function it_is_possible_to_write_a_setting_using_an_array_syntax()
    {
        $config = Config::getInstance();

        $config['beverage'] = 'beer';

        $this->assertSame('beer', $config['beverage']);
    }

    /** @test */
    public function it_is_possible_to_set_a_setting_to_null_by_using_vanilla_php_function_()
    {
        $config = Config::getInstance();
        $config['food'] = 'snails';

        unset($config['food']);

        $this->assertSame(null, $config['food']);
    }

    /**
     * iTodo
     *
     * - multidimensional arrays
     */
}
