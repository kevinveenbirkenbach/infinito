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

class SourceMemberInformationTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var SourceMemberInformationInterface
     */
    protected $sourceMemberInformation;

    public function setUp(): void
    {
        $this->source = new UserSource();
        $this->sourceMemberInformation = new SourceMemberInformation($this->source);
    }

    public function testOneDimension(): void
    {
        $this->source->getMemberRelation()->getMembers()->add(new TextSource());
        $this->assertEquals(1, $this->sourceMemberInformation->getAllMembers()->count());
    }

    public function testThreeDimension(): void
    {
        $source1 = new TextSource();
        $source2 = new FirstNameSource();
        $source2->getMemberRelation()->setMembers(new ArrayCollection([$source1]));
        $source3 = new FullPersonNameSource();
        $source3->getMemberRelation()->getMembers()->add($source2);
        $this->source->getMemberRelation()->getMembers()->add($source3);
        $this->assertEquals(3, $this->sourceMemberInformation->getAllMembers()->count());
    }

    public function testRecursion(): void
    {
        $recursiveSource = new UserSource();
        $recursiveSource->getMemberRelation()->getMembers()->add($this->source);
        $this->source->getMemberRelation()->getMembers()->add($recursiveSource);
        $this->assertEquals(2, $this->sourceMemberInformation->getAllMembers()->count());
    }
}
