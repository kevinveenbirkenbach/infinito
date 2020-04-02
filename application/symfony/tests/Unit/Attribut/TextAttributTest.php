<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\TextAttribut;
use Infinito\Attribut\TextAttributInterface;
use PHPUnit\Framework\TestCase;

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
