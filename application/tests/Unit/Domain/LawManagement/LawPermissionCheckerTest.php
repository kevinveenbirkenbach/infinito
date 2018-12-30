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
use App\Domain\SourceManagement\SourceMemberManager;

/**
 * @author kevinfrantz
 */
class LawPermissionCheckerTest extends TestCase
{
    /**
     * @var LawPermissionCheckerServiceInterface The service which checks the law
     */
    private $lawPermissionChecker;

    /**
     * @var LawInterface The law which applies to the source
     */
    private $law;

    /**
     * @var RightInterface
     */
    private $clientRight;

    /**
     * @var SourceInterface The client which requests a law
     */
    private $clientSource;

    /**
     * @var SourceInterface The source to which the law applies
     */
    private $source;

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
        $this->setSourceDummy();
        $this->setLawDummy();
        $this->setLawPermissionChecker();
        $this->setClientSourceDummy();
        $this->setClientRightDummy();
    }

    private function setLawPermissionChecker(): void
    {
        $this->lawPermissionChecker = new LawPermissionCheckerService($this->law);
    }

    private function setLawDummy(): void
    {
        $this->law = new Law();
        $this->law->setSource($this->source);
    }

    private function setSourceDummy(): void
    {
        $this->source = $this->getSourceMock();
        $this->source->setSlug('Requested Source');
    }

    private function setClientSourceDummy(): void
    {
        $this->clientSource = $this->getSourceMock();
        $this->clientSource->setSlug('Client Source');
    }

    private function setClientRightDummy(): void
    {
        $this->clientRight = new Right();
        $this->clientRight->setLayer(LayerType::SOURCE);
        $this->clientRight->setType(RightType::READ);
        $this->clientRight->setReciever($this->clientSource);
        $this->clientRight->setSource($this->source);
    }

    private function getClonedClientRight(): RightInterface
    {
        return clone $this->clientRight;
    }

    public function testInitialValues(): void
    {
        $this->assertFalse($this->checkClientPermission());
        $this->assertTrue($this->clientRight->getGrant());
    }

    public function testGeneralPermission(): void
    {
        $this->law->getRights()->add($this->getClonedClientRight());
        $this->assertTrue($this->checkClientPermission());
        $this->clientRight->setType(RightType::WRITE);
        $this->assertFalse($this->checkClientPermission());
    }

    public function testChildMemberPermission(): void
    {
        $parentSource = $this->getSourceMock();
        $parentSource->setSlug('Parent Source');
        $parentSourceMemberManager = new SourceMemberManager($parentSource);
        $parentSourceMemberManager->addMember($this->clientSource);
        /*
         * The following asserts just check if the SourceMemberManager works like expected
         */
        $this->assertEquals($parentSource, $this->clientSource->getMemberRelation()->getMemberships()->get(0)->getSource());
        $this->assertEquals($this->clientSource, $parentSource->getMemberRelation()->getMembers()->get(0)->getSource());
        $parentSourceRight = $this->getClonedClientRight();
        $parentSourceRight->setReciever($parentSource);
        $this->law->getRights()->add($parentSourceRight);
        /*
         * The following asserts just check if the in the tet defined values are like expected
         */
        $this->assertEquals($parentSourceRight, $this->law->getRights()->get(0));
        $this->assertEquals($parentSource, $parentSourceRight->getReciever());
        $this->assertEquals($this->source, $parentSourceRight->getSource());
        /*
         * The following asserts are the important asserts for the test
         */
        $this->assertTrue($this->checkClientPermission());
        $this->law->setRights(new ArrayCollection());
        $this->assertFalse($this->checkClientPermission());
    }

    public function testGetRightsByType(): void
    {
        $right = $this->getClonedClientRight();
        $right->setType(RightType::WRITE);
        $this->law->getRights()->add($right);
        $this->assertFalse($this->checkClientPermission());
        $right->setType(RightType::READ);
        $this->assertTrue($this->checkClientPermission());
    }

    public function testGetRightsByLayer(): void
    {
        $right = $this->getClonedClientRight();
        $right->setLayer(LayerType::LAW);
        $this->law->getRights()->add($right);
        $this->assertFalse($this->checkClientPermission());
        $right->setLayer(LayerType::SOURCE);
        $this->assertTrue($this->checkClientPermission());
    }

    public function testSortByPriority(): void
    {
        $right1 = $this->getClonedClientRight();
        $right1->setPriority(123);
        $right1->setGrant(false);
        $right1->setReciever($this->clientSource);
        $right2 = $this->getClonedClientRight();
        $right2->setPriority(456);
        $right2->setGrant(true);
        $right2->setReciever($this->clientSource);
        $this->law->setRights(new ArrayCollection([
            $right1,
            $right2,
        ]));
        $this->assertFalse($this->checkClientPermission());
        $right2->setPriority(789);
        $right1->setPriority(101112);
        $this->assertTrue($this->checkClientPermission());
    }

    public function testMemberFilter(): void
    {
        $right1 = $this->getClonedClientRight();
        $right1->setPriority(123);
        $right1->setGrant(false);
        $right1->setReciever($this->getSourceMock());
        $right1->getReciever()->setSlug('Rigth1 Reciever');
        $right2 = $this->getClonedClientRight();
        $right2->setPriority(456);
        $right2->setGrant(true);
        $right2->setReciever($this->clientSource);
        $this->law->setRights(new ArrayCollection([
            $right1,
            $right2,
        ]));
        $this->assertTrue($this->checkClientPermission());
    }
}
