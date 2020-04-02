<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\RecieverAttribut;
use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Entity\Source\AbstractSource;
use PHPUnit\Framework\TestCase;

class RecieverAttributTest extends TestCase
{
    /**
     * @var RecieverAttributInterface
     */
    protected $reciever;

    public function setUp(): void
    {
        $this->reciever = new class() implements RecieverAttributInterface {
            use RecieverAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->assertFalse($this->reciever->hasReciever());
        $this->expectException(\TypeError::class);
        $this->reciever->getReciever();
    }

    public function testAccessors(): void
    {
        $reciever = $this->createMock(AbstractSource::class);
        $this->assertFalse($this->reciever->hasReciever());
        $this->assertNull($this->reciever->setReciever($reciever));
        $this->assertEquals($reciever, $this->reciever->getReciever());
        $this->assertTrue($this->reciever->hasReciever());
    }
}
