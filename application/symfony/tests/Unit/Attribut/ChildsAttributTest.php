<?php

namespace Attribut;

use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Attribut\ChildsAttribut;
use Infinito\Attribut\ChildsAttributInterface;
use PHPUnit\Framework\TestCase;

class ChildsAttributTest extends TestCase
{
    /**
     * @var ChildsAttributInterface
     */
    protected $childs;

    public function setUp(): void
    {
        $this->childs = new class() implements ChildsAttributInterface {
            use ChildsAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->childs->getChilds();
    }

    public function testAccessors(): void
    {
        $childs = new ArrayCollection();
        $this->assertNull($this->childs->setChilds($childs));
        $this->assertEquals($childs, $this->childs->getChilds());
    }
}
