<?php

namespace Infinito\Tests\Unit;

use Infinito\Kernel;
use Tests\AbstractTestCase;

/**
 * This tests just exist to keep the code covering high.
 * They're also helpfull to see if the symfony core changed.
 *
 * @author kevinfrantz
 */
class KernelTest extends AbstractTestCase
{
    /**
     * @var Kernel
     */
    protected $kernel;

    public function setUp(): void
    {
        $this->kernel = new Kernel('test', false);
    }

    public function testLogDir(): void
    {
        $this->assertEquals(true, is_string($this->kernel->getLogDir()));
    }

    public function testConfigureContainer(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->invokeMethod($this->kernel, 'configureContainer', [null, null]));
    }

    public function testConfigureRoutes(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->invokeMethod($this->kernel, 'configureRoutes', [null, null]));
    }
}
