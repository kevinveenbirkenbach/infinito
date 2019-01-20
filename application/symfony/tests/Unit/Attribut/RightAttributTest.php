<?php

namespace App\Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Attribut\RightAttributInterface;
use App\Attribut\RightAttribut;
use App\Entity\Meta\RightInterface;

class RightAttributTest extends TestCase
{
    /***
     * @var RightAttributInterface
     */
    private $rightAttribut;

    public function setUp(): void
    {
        $this->rightAttribut = new class() implements RightAttributInterface {
            use RightAttribut;
        };
    }

    public function testAccessors(): void
    {
        $right = $this->createMock(RightInterface::class);
        $this->assertNull($this->rightAttribut->setRight($right));
        $this->assertEquals($right, $this->rightAttribut->getRight());
    }
}
