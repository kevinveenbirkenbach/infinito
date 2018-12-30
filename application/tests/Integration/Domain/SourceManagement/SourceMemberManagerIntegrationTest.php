<?php

namespace Tests\Integration\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMemberManagerInterface;
use App\Entity\Source\AbstractSource;
use App\Domain\SourceManagement\SourceMemberManager;
use App\Domain\SourceManagement\SourceMemberInformation;
use App\Domain\SourceManagement\SourceMembershipInformation;

class SourceMemberManagerIntegrationTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var SourceMemberManagerInterface
     */
    private $sourceMemberManager;

    private function createSource(): SourceInterface
    {
        return new class() extends AbstractSource {
        };
    }

    public function setUp(): void
    {
        $this->source = $this->createSource();
        $this->sourceMemberManager = new SourceMemberManager($this->source);
    }

    public function testSourceMemberInformationIntegration(): void
    {
        $childSource = $this->createSource();
        $sourceMemberInformation = new SourceMemberInformation($this->source);
        $this->sourceMemberManager->addMember($childSource);
        $this->assertEquals($childSource, $sourceMemberInformation->getAllMembers()->get(0));
        $this->sourceMemberManager->removeMember($childSource);
        $this->assertEquals(0, $sourceMemberInformation->getAllMembers()->count());
    }

    public function testSourceMembershipInformationIntegration(): void
    {
        $parentSource = $this->createSource();
        $sourceMemberInformation = new SourceMembershipInformation($this->source);
        $this->sourceMemberManager->addMembership($parentSource);
        $this->assertEquals($parentSource, $sourceMemberInformation->getAllMemberships()->get(0));
        $this->sourceMemberManager->removeMembership($parentSource);
        $this->assertEquals(0, $sourceMemberInformation->getAllMemberships()->count());
    }
}
