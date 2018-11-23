<?php

namespace Tests\Unit\Entity\Source\Primitive\Text;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Primitive\Text\TextSourceInterface;
use App\Entity\Source\Primitive\Text\TextSource;

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
