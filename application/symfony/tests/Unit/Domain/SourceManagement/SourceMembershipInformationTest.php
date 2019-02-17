<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\SourceManagement\SourceMembershipInformationInterface;
use Infinito\Domain\SourceManagement\SourceMembershipInformation;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Source\Primitive\Name\FirstNameSource;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Entity\Source\Complex\FullPersonNameSource;

class SourceMembershipInformationTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var SourceMembershipInformationInterface
     */
    protected $sourceMembershipInformation;

    public function setUp(): void
    {
        $this->source = new UserSource();
        $this->sourceMembershipInformation = new SourceMembershipInformation($this->source);
    }

    public function testOneDimension(): void
    {
        $this->source->getMemberRelation()->getMemberships()->add((new TextSource())->getMemberRelation());
        $this->assertEquals(1, $this->sourceMembershipInformation->getAllMemberships()->count());
    }

    public function testThreeDimension(): void
    {
        $source1 = new TextSource();
        $source2 = new FirstNameSource();
        $source2->getMemberRelation()->setMemberships(new ArrayCollection([$source1->getMemberRelation()]));
        $source3 = new FullPersonNameSource();
        $source3->getMemberRelation()->getMemberships()->add($source2->getMemberRelation());
        $this->source->getMemberRelation()->getMemberships()->add($source3->getMemberRelation());
        $this->assertEquals(3, $this->sourceMembershipInformation->getAllMemberships()->count());
    }

    public function testRecursion(): void
    {
        $recursiveSource = new UserSource();
        $recursiveSource->getMemberRelation()->getMemberships()->add($this->source->getMemberRelation());
        $this->source->getMemberRelation()->getMemberships()->add($recursiveSource->getMemberRelation());
        $this->assertEquals(2, $this->sourceMembershipInformation->getAllMemberships()->count());
    }

    public function testError(): void
    {
        $this->expectException(\Error::class);
        $this->source->getMemberRelation()->getMemberships()->add($this->createSourceMock());
        $this->sourceMembershipInformation->getAllMemberships();
    }
}
