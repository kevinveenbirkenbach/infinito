<?php

namespace Tests\Unit\Logic;

use Infinito\Logic\Result\Result;
use Infinito\Logic\Result\ResultInterface;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @var ResultInterface
     */
    protected $result;

    public function setUp(): void
    {
        $this->result = new Result();
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->result->getValue();
        $this->expectException(\TypeError::class);
        $this->result->getBool();
    }

    public function testSetBool(): void
    {
        $bool = true;
        $this->assertNull($this->result->setBool($bool));
        $this->assertEquals($bool, $this->result->getBool());
        $bool = false;
        $this->assertNull($this->result->setBool($bool));
        $this->assertEquals($bool, $this->result->getBool());
        $this->expectException(\TypeError::class);
        $bool = null;
        $this->assertNull($this->result->setBool($bool));
        $this->assertEquals($bool, $this->result->getBool());
    }

    public function testSetValue(): void
    {
        $value = 'test';
        $this->assertNull($this->result->setValue($value));
        $this->assertEquals($value, $this->result->getValue());
        $value = null;
        $this->assertNull($this->result->setValue($value));
        $this->assertEquals($value, $this->result->getValue());
        $value = 123;
        $this->assertNull($this->result->setValue($value));
        $this->assertEquals($value, $this->result->getValue());
        $value = new class() {
        };
        $this->assertNull($this->result->setValue($value));
        $this->assertEquals($value, $this->result->getValue());
    }

    public function testSetAll(): void
    {
        $value = 123;
        $this->assertNull($this->result->setAll($value));
        $this->assertEquals($value, $this->result->getValue());
        $this->assertEquals(true, $this->result->getBool());
        $value = null;
        $this->assertNull($this->result->setAll($value));
        $this->assertEquals($value, $this->result->getValue());
        $this->assertEquals(false, $this->result->getBool());
        $value = '';
        $this->assertNull($this->result->setAll($value));
        $this->assertEquals($value, $this->result->getValue());
        $this->assertEquals(false, $this->result->getBool());
        $value = true;
        $this->assertNull($this->result->setAll($value));
        $this->assertEquals($value, $this->result->getValue());
        $this->assertEquals($value, $this->result->getBool());
        $value = false;
        $this->assertNull($this->result->setAll($value));
        $this->assertEquals($value, $this->result->getValue());
        $this->assertEquals($value, $this->result->getBool());
        $value = new class() {
        };
        $this->assertNull($this->result->setAll($value));
        $this->assertEquals($value, $this->result->getValue());
        $this->assertEquals(true, $this->result->getBool());
    }
}
