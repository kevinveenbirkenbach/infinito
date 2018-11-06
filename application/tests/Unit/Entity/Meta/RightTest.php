<?php

namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\DBAL\Types\RightType;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\Entity\Meta\Law;

/**
 * @todo Implement reciever test
 *
 * @author kevinfrantz
 */
class RightTest extends TestCase
{
    /**
     * @var RightInterface
     */
    protected $right;

    public function setUp(): void
    {
        $this->right = new Right();
    }

    public function testConstructorGeneral(): void
    {
        $this->assertEquals($this->right, $this->right->getReciever()->getRight());
        $this->assertTrue($this->right->getGrant());
    }

    public function testConstructorLayer(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getLayer());
    }

    public function testConstructorLaw(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getLaw());
    }

    public function testConstructorCondition(): void
    {
        $this->expectException(\TypeError::class);
        $this->right->getCondition();
    }

    public function testConstructorType(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getType());
    }

    public function testLaw(): void
    {
        $law = new Law();
        $this->assertNull($this->right->setLaw($law));
        $this->assertEquals($law, $this->right->getLaw());
    }

    public function testRight(): void
    {
        $this->assertNull($this->right->setType(RightType::READ));
        $this->assertEquals(RightType::READ, $this->right->getType());
    }
}
