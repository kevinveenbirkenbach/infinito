<?php

namespace Tests\Unit\Entity\Source\Collection;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\AbstractSource;
use App\Entity\Source\Complex\Collection\TreeCollectionSourceInterface;
use App\Entity\Source\Complex\Collection\TreeCollectionSource;

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
        $member = new class() extends AbstractSource {
        };
        $this->tree->setCollection(new ArrayCollection([
            $member,
        ]));
        $this->assertEquals($member, $this->tree->getCollection()
            ->get(0));
    }
}
