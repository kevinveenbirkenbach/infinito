<?php

namespace Tests\Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\SourceManagement\SourceMembershipInformationInterface;
use App\Domain\SourceManagement\SourceMembershipInformation;
use App\Entity\Source\SourceInterface;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Primitive\Text\TextSource;
use App\Entity\Source\Primitive\Name\FirstNameSource;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\Complex\FullPersonNameSource;

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
        $this->source->getMemberRelation()->getMemberships()->add(new TextSource());
        $this->assertEquals(1, $this->sourceMembershipInformation->getAllMemberships()->count());
    }

    public function testThreeDimension(): void
    {
        $source1 = new TextSource();
        $source2 = new FirstNameSource();
        $source2->getMemberRelation()->setMemberships(new ArrayCollection([$source1]));
        $source3 = new FullPersonNameSource();
        $source3->getMemberRelation()->getMemberships()->add($source2);
        $this->source->getMemberRelation()->getMemberships()->add($source3);
        $this->assertEquals(3, $this->sourceMembershipInformation->getAllMemberships()->count());
    }

    public function testRecursion(): void
    {
        $recursiveSource = new UserSource();
        $recursiveSource->getMemberRelation()->getMemberships()->add($this->source);
        $this->source->getMemberRelation()->getMemberships()->add($recursiveSource);
        $this->assertEquals(2, $this->sourceMembershipInformation->getAllMemberships()->count());
    }
}
