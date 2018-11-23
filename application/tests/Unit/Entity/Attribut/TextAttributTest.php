<?php

namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\TextAttributInterface;
use App\Entity\Attribut\TextAttribut;

/**
 * @author kevinfrantz
 */
class TextAttributTest extends TestCase
{
    /**
     * @var TextAttributInterface
     */
    protected $textAttribut;

    public function setUp(): void
    {
        $this->textAttribut = new class() implements TextAttributInterface {
            use TextAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->textAttribut->getText();
    }

    public function testAccessors(): void
    {
        $text = 'Hello World!';
        $this->assertNull($this->textAttribut->setText($text));
        $this->assertEquals($text, $this->textAttribut->getText());
    }
}
