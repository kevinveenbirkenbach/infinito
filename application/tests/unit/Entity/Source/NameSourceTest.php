<?php

namespace tests\unit\Entity\Source;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\NameSourceInterface;
use App\Entity\Source\NameSource;

/**
 * @author kevinfrantz
 */
class NameSourceTest extends TestCase
{
    /**
     * @var NameSourceInterface
     */
    protected $nameSource;

    public function setUp(): void
    {
        $this->nameSource = new NameSource();
    }

    public function testName(): void
    {
        $this->assertEquals('', $this->nameSource->getName());
        $name = 'Hello World!';
        $this->nameSource->setName($name);
        $this->assertEquals($name, $this->nameSource->getName());
    }
}
