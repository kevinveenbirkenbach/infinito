<?php

namespace Tests\Unit\Entity\Source\Complex\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\Complex\Collection\TreeCollectionSource;
use Infinito\Entity\Source\Complex\Collection\TreeCollectionSourceInterface;
use Infinito\Entity\Source\PureSource;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class TreeCollectionSourceTest extends TestCase
{
    /**
     * @var TreeCollectionSourceInterface
     */
    protected $tree;

    public function setUp(): void
    {
        $this->tree = new TreeCollectionSource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->tree->getCollection());
        $this->assertInstanceOf(TreeCollectionSourceInterface::class, $this->tree);
    }

    public function testAccessors()
    {
        $member = new PureSource();
        $this->tree->setCollection(new ArrayCollection([
            $member,
        ]));
        $this->assertEquals($member, $this->tree->getCollection()
            ->get(0));
    }
}
