<?php

namespace Unit\Domain\LawManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\LawManagement\LawPermissionCheckerService;
use App\Domain\LawManagement\LawPermissionCheckerServiceInterface;
use App\Entity\Source\SourceInterface;
use App\Entity\Source\AbstractSource;
use App\Entity\Meta\Right;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Meta\Law;
use App\Entity\Meta\LawInterface;
use App\Entity\Meta\RightInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
class LawPermissionCheckerTest extends TestCase
{
    /**
     * @var LawPermissionCheckerServiceInterface
     */
    protected $lawPermissionChecker;

    /**
     * @var LawInterface
     */
    protected $law;

    /**
     * @var RightInterface
     */
    protected $clientRight;

    /**
     * @var SourceInterface
     */
    private $clientSource;

    private function getSourceMock(): SourceInterface
    {
        return new class() extends AbstractSource {
        };
    }

    private function checkClientPermission(): bool
    {
        return $this->lawPermissionChecker->hasPermission($this->clientRight);
    }

    public function setUp(): void
    {
        $this->clientRight = new Right();
        $this->law = new Law();
        $this->lawPermissionChecker = new LawPermissionCheckerService($this->law);
        $this->clientSource = $this->getSourceMock();
        $this->clientRight->setSource($this->clientSource);
        $this->clientRight->setLayer(LayerType::SOURCE);
        $this->clientRight->setType(RightType::READ);
    }

    public function testGeneralPermission(): void
    {
        $this->assertFalse($this->checkClientPermission());
        $lawRight = clone $this->clientRight;
        $lawRight->setReciever($this->clientSource);
        $this->law->getRights()->add($lawRight);
        $this->assertTrue($this->checkClientPermission());
        $this->clientRight->setType(RightType::WRITE);
        $this->assertFalse($this->checkClientPermission());
    }

    public function testMemberPermission(): void
    {
        $parentSource = $this->getSourceMock();
        $this->clientRight->getSource()->getMemberRelation()->getMemberships()->add($parentSource);
        $parentSource->getMemberRelation()->getMembers()->add($this->clientRight->getSource());
        $lawRight = clone $this->clientRight;
        $lawRight->setReciever($parentSource);
        $this->law->getRights()->add($lawRight);
        $permission = $this->lawPermissionChecker->hasPermission($this->clientRight);
        $this->assertTrue($permission);
        $this->law->setRights(new ArrayCollection());
        $permission = $this->lawPermissionChecker->hasPermission($this->clientRight);
        $this->assertFalse($permission);
    }

    public function testSort(): void
    {
        $right1 = clone $this->clientRight;
        $right1->setPriority(123);
        $right1->setGrant(false);
        $right1->setReciever($this->clientSource);
        $right2 = clone $this->clientRight;
        $right2->setPriority(456);
        $right2->setGrant(true);
        $right2->setReciever($this->clientSource);
        $this->law->setRights(new ArrayCollection([$right1, $right2]));
        $this->assertFalse($this->checkClientPermission());
        $right2->setPriority(789);
        $right1->setPriority(101112);
        $this->assertTrue($this->checkClientPermission());
    }
}
