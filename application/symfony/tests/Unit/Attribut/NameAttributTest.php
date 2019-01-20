<?php

namespace App\Attribut;

use PHPUnit\Framework\TestCase;

class NameAttributTest extends TestCase
{
    /**
     * @var NameAttributInterface
     */
    public $name;

    public function setUp(): void
    {
        $this->name = new class() implements NameAttributInterface {
            use NameAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->name->getName();
    }

    public function testAccessors(): void
    {
        $name = 'hello world!';
        $this->assertNull($this->name->setName($name));
        $this->assertEquals($name, $this->name->getName());
    }
}
