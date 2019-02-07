<?php

namespace Attribut;

use PHPUnit\Framework\TestCase;
use App\Attribut\ChildsAttributInterface;
use App\Attribut\ChildsAttribut;
use Doctrine\Common\Collections\ArrayCollection;

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
