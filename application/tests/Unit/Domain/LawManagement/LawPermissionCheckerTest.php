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
    protected $client;

    private function getSourceMock(): SourceInterface
    {
        return new class() extends AbstractSource {
        };
    }

    private function checkClientPermission(): bool
    {
        return $this->lawPermissionChecker->hasPermission($this->client);
    }

    public function setUp(): void
    {
        $this->client = new Right();
        $this->law = new Law();
        $this->lawPermissionChecker = new LawPermissionCheckerService($this->law);
        $source = $this->getSourceMock();
        $this->client->setSource($source);
        $this->client->setLayer(LayerType::SOURCE);
        $this->client->setType(RightType::READ);
    }

    public function testGeneralPermission(): void
    {
        $this->assertFalse($this->checkClientPermission());
        $lawRight = clone $this->client;
        $this->law->getRights()->add($lawRight);
        $this->assertTrue($this->checkClientPermission());
        $this->client->setType(RightType::WRITE);
        $this->assertFalse($this->checkClientPermission());
    }

    public function testMemberPermission(): void
    {
        $parentSource = $this->getSourceMock();
        $this->client->getSource()->getMemberRelation()->getMemberships()->add($parentSource);
        $parentSource->getMemberRelation()->getMembers()->add($this->client->getSource());
        $lawRight = clone $this->client;
        $lawRight->setSource($parentSource);
        $this->law->getRights()->add($lawRight);
        $permission = $this->lawPermissionChecker->hasPermission($this->client);
        $this->assertTrue($permission);
        $this->law->setRights(new ArrayCollection());
        $permission = $this->lawPermissionChecker->hasPermission($this->client);
        $this->assertFalse($permission);
    }

    public function testSort(): void
    {
        $right1 = clone $this->client;
        $right1->setPriority(123);
        $right1->setGrant(false);
        $right2 = clone $this->client;
        $right2->setPriority(456);
        $right2->setGrant(true);
        $this->law->setRights(new ArrayCollection([$right1, $right2]));
        $this->assertFalse($this->checkClientPermission());
        $right2->setPriority(789);
        $right1->setPriority(101112);
        $this->assertTrue($this->checkClientPermission());
    }

//     public function test2Rights():void{

//     }
}
