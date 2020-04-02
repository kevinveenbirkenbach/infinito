<?php

namespace Tests\Unit\Domain\Secure;

use Infinito\Attribut\SourceAttribut;
use Infinito\Attribut\SourceAttributInterface;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Secure\SecureSourceChecker;
use Infinito\Domain\Secure\SecureSourceCheckerInterface;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Exception\Permission\NoSourcePermissionException;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class SecureSourceCheckerTest extends TestCase
{
    /**
     * @var SourceInterface|SourceAttributInterface
     */
    private $source;

    /**
     * @var SourceInterface
     */
    private $recieverSource;

    /**
     * @var SecureSourceCheckerInterface
     */
    private $securerSourceChecker;

    private function createSourceMock(): SourceInterface
    {
        return new class() extends AbstractSource implements SourceAttributInterface {
            use SourceAttribut;
        };
    }

    public function setUp(): void
    {
        $this->source = $this->createSourceMock();
        $this->recieverSource = $this->createSourceMock();
        $this->securerSourceChecker = new SecureSourceChecker($this->source);
    }

    public function testFirstLevel(): void
    {
        $right = new Right();
        $right->setLayer(LayerType::SOURCE);
        $right->setActionType(CRUDType::UPDATE);
        $right->setReciever($this->recieverSource);
        $right->setSource($this->source);
        $this->source->getLaw()->getRights()->add($right);
        $requestedRight = clone $right;
        $this->assertTrue($this->securerSourceChecker->hasPermission($requestedRight));
        $requestedRight->setActionType(CRUDType::READ);
        $this->assertFalse($this->securerSourceChecker->hasPermission($requestedRight));
    }

    public function testSecondLevel(): void
    {
        $right = new Right();
        $right->setLayer(LayerType::SOURCE);
        $right->setActionType(CRUDType::UPDATE);
        $right->setReciever($this->recieverSource);
        $right->setSource($this->source);
        $this->source->getLaw()->getRights()->add($right);
        $attributSource = $this->createSourceMock();
        $childRight = clone $right;
        $attributSource->getLaw()->getRights()->add($childRight);
        $this->source->setSource($attributSource);
        $requestedRight = clone $right;
        $this->assertTrue($this->securerSourceChecker->hasPermission($requestedRight));
        $childRight->setActionType(CRUDType::READ);
        $this->expectException(NoSourcePermissionException::class);
        $this->securerSourceChecker->hasPermission($requestedRight);
    }

    public function testThirdLevel(): void
    {
        $right = new Right();
        $right->setLayer(LayerType::SOURCE);
        $right->setActionType(CRUDType::UPDATE);
        $right->setReciever($this->recieverSource);
        $right->setSource($this->source);
        $this->source->getLaw()->getRights()->add($right);
        $attribut1Source = $this->createSourceMock();
        $attribut1Source->getLaw()->getRights()->add($right);
        $this->source->setSource($attribut1Source);
        $childRight = clone $right;
        $attribut2Source = $this->createSourceMock();
        $attribut2Source->getLaw()->getRights()->add($childRight);
        $attribut1Source->setSource($attribut2Source);
        $requestedRight = clone $right;
        $this->assertTrue($this->securerSourceChecker->hasPermission($requestedRight));
        $childRight->setActionType(CRUDType::READ);
        $this->expectException(NoSourcePermissionException::class);
        $this->securerSourceChecker->hasPermission($requestedRight);
    }

    public function testRightAppliesToAll(): void
    {
        $right = new Right();
        $right->setLayer(LayerType::SOURCE);
        $right->setActionType(CRUDType::READ);
        $right->setReciever($this->recieverSource);
        $right->setSource($this->source);
        $this->assertFalse($this->securerSourceChecker->hasPermission($right));
        $requestedRight = new Right();
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setActionType(CRUDType::READ);
        $requestedRight->setSource($this->source);
        $this->source->getLaw()->getRights()->add($requestedRight);
        $this->assertTrue($this->securerSourceChecker->hasPermission($right));
        $requestedRight->setReciever($this->createSourceMock());
        $this->assertFalse($this->securerSourceChecker->hasPermission($right));
    }
}
