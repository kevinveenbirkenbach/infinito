<?php

namespace Tests\Unit\Entity\Source\Complex\Collection;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\Complex\Collection\TreeCollectionSourceInterface;
use App\Entity\Source\Complex\Collection\TreeCollectionSource;
use App\Entity\Source\PureSource;

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
