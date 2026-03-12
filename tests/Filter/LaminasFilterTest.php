<?php

namespace ColeoTest\Form\Filter;

use PHPUnit\Framework\TestCase;
use Coleo\Form\Filter\LaminasFilter;

/**
 * LaminasFilterTest
 * @group group
 */
class LaminasFilterTest extends TestCase
{
    private LaminasFilter $filter;

    public function setUp(): void
    {
        $this->filter = new LaminasFilter();
    }

    /** @test */
    public function testStringToUpper()
    {
        $this->filter->addRule('stringToUpper');
        $this->assertEquals("WORLD", $this->filter->clean("world"));
    }

    public function testAllowList()
    {
        $this->filter->addRule('allowList', [
             'list' => ['allowed-1', 'allowed-2']
        ]);

        $this->assertEquals('allowed-1', $this->filter->clean('allowed-1'));
        $this->assertNull($this->filter->clean('not-allowed'));
    }

    public function testBasename()
    {
        $this->filter->addRule('baseName');
        $this->assertEquals('filename.txt', $this->filter->clean('/vol/tmp/filename.txt'));
    }

    public function testBoolean()
    {
        $this->filter->addRule('boolean');

        $this->assertFalse($this->filter->clean(''));
        $this->assertFalse($this->filter->clean(null));
        $this->assertFalse($this->filter->clean('0'));
        $this->assertFalse($this->filter->clean(0));
        $this->assertFalse($this->filter->clean(0.0));
    }

    public function testLocalizedBoolean()
    {
        $this->filter->addRule('boolean', [
            'type' => 'localized',
            'translations' => [
                'yes' => true,
                'no' => false
            ]
        ]);

        $this->assertTrue($this->filter->clean('yes'));
        $this->assertFalse($this->filter->clean('no'));
    }

    public function testCustomCallback()
    {
        $this->filter->addRule('callback', [
            'callback' => function (mixed $input): mixed {
                return "Hello, " . $input . "!";
            }
        ]);

        $this->assertEquals("Hello, World!", $this->filter->clean("World"));
    }

    public function testCustomCallbackWithAdditionalParams()
    {
        $this->filter->addRule('callback', [
            'callback' => function (string $name, string $prefix, string $sufix): string {
                return $prefix . ', ' . $name . $sufix;
            },
            'callback_params' => [
                'prefix' => 'Mr',
                'sufix' => '!'
            ]
        ]);
        $this->assertEquals('Mr, Johnson!', $this->filter->clean('Johnson'));
    }

    public function testBuildInFunctionsAsCallback()
    {
        $this->filter->addRule('callback', 'strrev')->addRule('callback', 'trim');
        $this->assertEquals('olleH', $this->filter->clean('   Hello    '));
    }

    public function testDateSelect()
    {
        $this->filter->addRule('dateSelect');
        $this->assertEquals('2012-02-01', $this->filter->clean(['day' => '1', 'month' => '2', 'year' => '2012']));
    }

    public function testDateTimeFormatter()
    {
        $this->filter->addRule('dateTimeFormatter', [
            'format' => 'd-m-Y'
        ]);
        $this->assertEquals('16-08-2024', $this->filter->clean('2024-08-16 00:00:00'));
        $this->assertEquals('06-03-2024', $this->filter->clean(1_709_706_334));
    }

    public function testDenyList()
    {
        $this->filter->addRule('denyList', [
            'list' => ['forbidden-1', 'forbidden-2']
        ]);

        $this->assertNull($this->filter->clean('forbidden-1'));
        $this->assertEquals('allowed', $this->filter->clean('allowed'));
    }

    public function testDigits()
    {
        $this->filter->addRule('digits');
        $this->assertEquals('100', $this->filter->clean('It happened 100 years ago.'));
    }

    public function testDir()
    {
        $this->filter->addRule('dir');
        $this->assertEquals('/tmp/var', $this->filter->clean('/tmp/var/boo.txt'));
    }

    public function testHtmlEntities()
    {
        $this->filter->addRule('htmlEntities');
        $this->assertEquals('&lt;&gt;', $this->filter->clean('<>'));
    }

    public function testToFloat()
    {
        $this->filter->addRule('toFloat');
        $this->assertEquals(3.14, $this->filter->clean('3.14'));
    }

    public function testMonthSelect()
    {
        $this->filter->addRule('monthSelect');
        $this->assertEquals('2012-12', $this->filter->clean(['month' => '12', 'year' => '2012']));
    }
}
