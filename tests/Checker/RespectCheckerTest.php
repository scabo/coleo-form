<?php

namespace ColeoTest\Form\Checker;

use PHPUnit\Framework\TestCase;
use Coleo\Form\Checker\RespectChecker;

/**
 * RespectCheckerTest
 */
class RespectCheckerTest extends TestCase
{
    private RespectChecker $checker;

    public function setUp(): void
    {
        $this->checker = new RespectChecker();
        parent::setUp();
    }

    public function testIBAN()
    {
        $this->checker->addRule('iban');
        $result = $this->checker->check('hello, world');
        $this->assertEquals('"hello, world" must be a valid IBAN', $result['iban']);

        $result = $this->checker->check('SE35 5000 0000 0549 1000 0003');
        $this->assertTrue($result);
    }

    public function testIP()
    {
        $this->checker->addRule('ip')->addErrorMessage('ip', '$ip_address is not valid');
        $result = $this->checker->check('42434');
        $this->assertEquals('$ip_address is not valid', $result['ip']);

        $result = $this->checker->check('192.168.0.1');
        $this->assertTrue($result);
    }
}
