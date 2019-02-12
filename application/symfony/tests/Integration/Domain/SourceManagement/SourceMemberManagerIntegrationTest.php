<?php

namespace Tests\Integration\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMemberManagerInterface;
use App\Domain\SourceManagement\SourceMemberManager;
use App\Domain\SourceManagement\SourceMemberInformation;
use App\Domain\SourceManagement\SourceMembershipInformation;
use App\Entity\Source\PureSource;

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

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->source = new PureSource();
        $this->sourceMemberManager = new SourceMemberManager($this->source);
    }

    public function testSourceMemberInformationIntegration(): void
    {
        $childSource = new PureSource();
        $sourceMemberInformation = new SourceMemberInformation($this->source);
        $this->sourceMemberManager->addMember($childSource);
        $this->assertEquals($childSource, $sourceMemberInformation->getAllMembers()->get(0));
        $this->sourceMemberManager->removeMember($childSource);
        $this->assertEquals(0, $sourceMemberInformation->getAllMembers()->count());
    }

    public function testSourceMembershipInformationIntegration(): void
    {
        $parentSource = new PureSource();
        $sourceMemberInformation = new SourceMembershipInformation($this->source);
        $this->sourceMemberManager->addMembership($parentSource);
        $this->assertEquals($parentSource, $sourceMemberInformation->getAllMemberships()->get(0));
        $this->sourceMemberManager->removeMembership($parentSource);
        $this->assertEquals(0, $sourceMemberInformation->getAllMemberships()->count());
    }
}
