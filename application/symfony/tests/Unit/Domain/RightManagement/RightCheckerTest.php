<?php

namespace Tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\Entity\Source\SourceInterface;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Domain\RightManagement\RightCheckerInterface;
use App\Domain\RightManagement\RightChecker;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Source\PureSource;

/**
 * @author kevinfrantz
 */
class RightCheckerTest extends TestCase
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $layer;

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var RightInterface
     */
    private $right;

    /**
     * @var RightCheckerInterface
     */
    private $rightManager;

    public function setUp(): void
    {
        $this->layer = LayerType::MEMBER;
        $this->type = CRUDType::READ;
        $this->source = new PureSource();
        $this->right = new Right();
        $this->right->setReciever($this->source);
        $this->right->setCrud($this->type);
        $this->right->setLayer($this->layer);
        $this->rightManager = new RightChecker($this->right);
    }

    public function testFirstDimension(): void
    {
        $granted = $this->rightManager->isGranted($this->layer, $this->type, $this->source);
        $this->assertTrue($granted);
        $notGranted = $this->rightManager->isGranted(LayerType::SOURCE, $this->type, $this->source);
        $this->assertFalse($notGranted);
        $notGranted2 = $this->rightManager->isGranted($this->layer, CRUDType::UPDATE, $this->source);
        $this->assertFalse($notGranted2);
        $this->right->setGrant(false);
        $notGranted3 = $this->rightManager->isGranted($this->layer, $this->type, $this->source);
        $this->assertFalse($notGranted3);
        $notGranted4 = $this->rightManager->isGranted($this->layer, $this->type, new PureSource());
        $this->assertFalse($notGranted4);
    }

    public function testSecondDimension(): void
    {
        $secondSource = new PureSource();
        $this->source->getMemberRelation()->getMembers()->add($secondSource->getMemberRelation());
        $granted = $this->rightManager->isGranted($this->layer, $this->type, $secondSource);
        $this->assertTrue($granted);
        $notGranted = $this->rightManager->isGranted(LayerType::SOURCE, $this->type, $secondSource);
        $this->assertFalse($notGranted);
        $notGranted2 = $this->rightManager->isGranted($this->layer, CRUDType::UPDATE, $secondSource);
        $this->assertFalse($notGranted2);
        $this->right->setGrant(false);
        $notGranted3 = $this->rightManager->isGranted($this->layer, $this->type, $secondSource);
        $this->assertFalse($notGranted3);
    }

    public function testThirdDimension(): void
    {
        $thirdSource = new PureSource();
        $secondSource = new PureSource();
        $secondSource->getMemberRelation()->getMembers()->add($thirdSource->getMemberRelation());
        $this->source->getMemberRelation()->getMembers()->add($secondSource->getMemberRelation());
        $granted = $this->rightManager->isGranted($this->layer, $this->type, $thirdSource);
        $this->assertTrue($granted);
        $notGranted = $this->rightManager->isGranted(LayerType::SOURCE, $this->type, $thirdSource);
        $this->assertFalse($notGranted);
        $notGranted2 = $this->rightManager->isGranted($this->layer, CRUDType::UPDATE, $thirdSource);
        $this->assertFalse($notGranted2);
        $this->right->setGrant(false);
        $notGranted3 = $this->rightManager->isGranted($this->layer, $this->type, $thirdSource);
        $this->assertFalse($notGranted3);
    }

    public function testAppliesToAll(): void
    {
        $this->assertNull($this->right->setReciever(null));
        $this->assertTrue($this->rightManager->isGranted($this->layer, $this->type, $this->source));
        $source2 = new PureSource();
        $this->assertTrue($this->rightManager->isGranted($this->layer, $this->type, $source2));
        $source3 = new PureSource();
        $this->assertNull($this->right->setReciever($source3));
        $this->assertTrue($this->rightManager->isGranted($this->layer, $this->type, $source3));
        $this->assertFalse($this->rightManager->isGranted($this->layer, $this->type, $source2));
    }
}
