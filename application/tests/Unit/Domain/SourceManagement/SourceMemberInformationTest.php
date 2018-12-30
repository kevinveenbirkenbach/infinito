<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Primitive\Text\TextSource;
use App\Entity\Source\Primitive\Name\FirstNameSource;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\Complex\FullPersonNameSource;
use App\Domain\SourceManagement\SourceMemberInformation;
use App\Domain\SourceManagement\SourceMemberInformationInterface;
use App\Entity\Source\AbstractSource;

class SourceMemberInformationTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var SourceMemberInformationInterface
     */
    private $sourceMemberInformation;

    private function createSourceMock(): SourceInterface
    {
        return new class() extends AbstractSource {
        };
    }

    public function setUp(): void
    {
        $this->source = new UserSource();
        $this->sourceMemberInformation = new SourceMemberInformation($this->source);
    }

    public function testOneDimension(): void
    {
        $this->source->getMemberRelation()->getMembers()->add((new TextSource())->getMemberRelation());
        $allSourceMembers = $this->sourceMemberInformation->getAllMembers();
        $this->assertEquals(1, $allSourceMembers->count());
        $this->assertInstanceOf(SourceInterface::class, $allSourceMembers[0]);
    }

    public function testThreeDimension(): void
    {
        $source1 = new TextSource();
        $source2 = new FirstNameSource();
        $source2->getMemberRelation()->setMembers(new ArrayCollection([$source1->getMemberRelation()]));
        $source3 = new FullPersonNameSource();
        $source3->getMemberRelation()->getMembers()->add($source2->getMemberRelation());
        $this->source->getMemberRelation()->getMembers()->add($source3->getMemberRelation());
        $allSourceMembers = $this->sourceMemberInformation->getAllMembers();
        $this->assertEquals(3, $allSourceMembers->count());
        foreach ($allSourceMembers as $sourceMember) {
            $this->assertInstanceOf(SourceInterface::class, $sourceMember);
        }
    }

    public function testRecursion(): void
    {
        $recursiveSource = new UserSource();
        $recursiveSource->getMemberRelation()->getMembers()->add($this->source->getMemberRelation());
        $this->source->getMemberRelation()->getMembers()->add($recursiveSource->getMemberRelation());
        $allSourceMembers = $this->sourceMemberInformation->getAllMembers();
        $this->assertEquals(2, $allSourceMembers->count());
        foreach ($allSourceMembers as $sourceMember) {
            $this->assertInstanceOf(SourceInterface::class, $sourceMember);
        }
    }

    public function testError(): void
    {
        $this->expectException(\Error::class);
        $this->source->getMemberRelation()->getMembers()->add($this->createSourceMock());
        $this->sourceMemberInformation->getAllMembers();
    }
}
