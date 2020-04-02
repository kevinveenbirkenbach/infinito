<?php

namespace Tests\Unit\Domain\Source;

use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Domain\Source\TreeSourceInformation;
use Infinito\Domain\Source\TreeSourceInformationInterface;
use Infinito\Entity\Source\Complex\Collection\TreeCollectionSource;
use Infinito\Entity\Source\SourceInterface;
use PHPUnit\Framework\TestCase;

class TreeSourceInformationTest extends TestCase
{
    /**
     * @var TreeSourceInformationInterface
     */
    protected $treeService;

    public function setUp(): void
    {
        $tree1 = new TreeCollectionSource();
        $tree2 = new TreeCollectionSource();
        $tree3 = new TreeCollectionSource();
        $tree4 = new TreeCollectionSource();
        $tree5 = new TreeCollectionSource(new ArrayCollection([$tree2]));
        $leave1 = $this->createMock(SourceInterface::class);
        $leave2 = $this->createMock(SourceInterface::class);
        $leave3 = $this->createMock(SourceInterface::class);
        $leave4 = $this->createMock(SourceInterface::class);
        $leave5 = $this->createMock(SourceInterface::class);
        $tree2->setCollection(new ArrayCollection([$leave3, $leave4, $tree5, $leave5]));
        $collection = new ArrayCollection([$tree2, $tree3, $leave1, $leave2, $tree4, $tree1]);
        $tree1->setCollection($collection);
        $this->treeService = new TreeSourceInformation($tree1);
    }

    public function testGetLeaves(): void
    {
        $this->assertEquals(2, $this->treeService->getLeaves()->count());
    }

    public function testGetBranches(): void
    {
        $this->assertEquals(4, $this->treeService->getBranches()->count());
    }

    public function testGetAllBranches(): void
    {
        $this->assertEquals(5, $this->treeService->getAllBranches()->count());
    }

    public function testGetAllLeaves(): void
    {
        $this->assertEquals(5, $this->treeService->getAllLeaves()->count());
    }
}
