<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Source\Primitive\Name\FirstNameSource;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Entity\Source\Complex\FullPersonNameSource;
use Infinito\Domain\SourceManagement\SourceMemberInformation;
use Infinito\Domain\SourceManagement\SourceMemberInformationInterface;
use Infinito\Entity\Source\PureSource;

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
        $this->source->getMemberRelation()->getMembers()->add(new PureSource());
        $this->sourceMemberInformation->getAllMembers();
    }
}
