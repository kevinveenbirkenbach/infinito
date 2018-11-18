<?php
namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Collection\TreeCollectionSourceInterface;
use App\Entity\Source\Collection\TreeCollectionSource;
use App\Entity\Source\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Domain\SourceManagement\TreeSourceServiceInterface;
use App\Domain\SourceManagement\TreeSourceService;

class TreeSourceServiceTest extends TestCase
{
    /**
     * 
     * @var TreeSourceServiceInterface
     */
    protected $treeService;
    
    public function setUp():void {
        $tree1 = new TreeCollectionSource();
        $tree2 = new TreeCollectionSource();
        $tree3 = new TreeCollectionSource();
        $leave1 = $this->createMock(SourceInterface::class);
        $leave2 = $this->createMock(SourceInterface::class);
        $collection = new ArrayCollection([$tree2,$tree3,$leave1,$leave2]);
        $tree1->setCollection($collection);
        $this->treeService = new TreeSourceService($tree1);
    }
    
    public function testGetLeaves():void{
        $this->assertEquals(2, $this->treeService->getLeaves()->count());
    }
}

