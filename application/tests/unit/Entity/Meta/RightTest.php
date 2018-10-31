<?php

namespace App\Entity\Meta;

use PHPUnit\Framework\TestCase;
use App\DBAL\Types\RightType;

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

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getLaw());
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
