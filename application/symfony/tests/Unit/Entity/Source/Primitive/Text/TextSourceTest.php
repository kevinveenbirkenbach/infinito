<?php

namespace Tests\Unit\Entity\Source\Primitive\Text;

use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Source\Primitive\Text\TextSourceInterface;
use PHPUnit\Framework\TestCase;

class TextSourceTest extends TestCase
{
    /**
     * @var TextSourceInterface
     */
    protected $textSource;

    public function setUp(): void
    {
        $this->textSource = new TextSource();
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->textSource->getText();
    }
}
