<?php

namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\EntityInterface;
use App\Entity\AbstractEntity;

class AbstractEntityTest extends TestCase
{
    /**
     * @var EntityInterface
     */
    protected $entity;

    public function setUp(): void
    {
        $this->entity = new class() extends AbstractEntity {
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->entity->getId();
        $this->entity->getVersion();
    }

    public function testVersion(): void
    {
        $version = 123;
        $this->assertNull($this->entity->setVersion($version));
        $this->assertEquals($version, $this->entity->getVersion());
    }

    public function testId(): void
    {
        $id = 123;
        $this->assertNull($this->entity->setId($id));
        $this->assertEquals($id, $this->entity->getId());
    }
}
