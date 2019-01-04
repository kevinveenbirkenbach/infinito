<?php

namespace Tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\Entity\Source\SourceInterface;
use App\DBAL\Types\LayerType;
use App\Domain\RightManagement\RightCheckerInterface;
use App\Domain\RightManagement\RightChecker;
use App\DBAL\Types\RightType;
use App\Entity\Source\PureSource;

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
        $this->layer = LayerType::RELATION;
        $this->type = RightType::READ;
        $this->source = new PureSource();
        $this->right = new Right();
        $this->right->setReciever($this->source);
        $this->right->setType($this->type);
        $this->right->setLayer($this->layer);
        $this->rightManager = new RightChecker($this->right);
    }

    public function testFirstDimension(): void
    {
        $granted = $this->rightManager->isGranted($this->layer, $this->type, $this->source);
        $this->assertTrue($granted);
        $notGranted = $this->rightManager->isGranted(LayerType::SOURCE, $this->type, $this->source);
        $this->assertFalse($notGranted);
        $notGranted2 = $this->rightManager->isGranted($this->layer, RightType::WRITE, $this->source);
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
        $notGranted2 = $this->rightManager->isGranted($this->layer, RightType::WRITE, $secondSource);
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
        $notGranted2 = $this->rightManager->isGranted($this->layer, RightType::WRITE, $thirdSource);
        $this->assertFalse($notGranted2);
        $this->right->setGrant(false);
        $notGranted3 = $this->rightManager->isGranted($this->layer, $this->type, $thirdSource);
        $this->assertFalse($notGranted3);
    }
}
