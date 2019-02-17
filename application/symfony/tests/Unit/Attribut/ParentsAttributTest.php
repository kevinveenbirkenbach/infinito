<?php

namespace Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\ParentsAttributInterface;
use Infinito\Attribut\ParentsAttribut;
use Doctrine\Common\Collections\ArrayCollection;

class ParentsAttributTest extends TestCase
{
    /**
     * @var ParentsAttributInterface
     */
    protected $parents;

    public function setUp(): void
    {
        $this->parents = new class() implements ParentsAttributInterface {
            use ParentsAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->parents->getParents();
    }

    public function testAccessors(): void
    {
        $parents = new ArrayCollection();
        $this->assertNull($this->parents->setParents($parents));
        $this->assertEquals($parents, $this->parents->getParents());
    }
}
