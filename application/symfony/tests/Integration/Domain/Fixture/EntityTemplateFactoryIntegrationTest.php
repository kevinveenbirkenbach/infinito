<?php

namespace tests\Integration\Domain\Fixture;

use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Fixture\EntityTemplateFactory;
use Infinito\Domain\Law\LawPermissionChecker;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\Source\Complex\UserSource;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class EntityTemplateFactoryIntegrationTest extends TestCase
{
    public function testStandartPublicRights(): void
    {
        $allowedActions = [ActionType::READ, ActionType::EXECUTE];
        $allowedLayers = [LayerType::SOURCE];
        $source = new class() extends AbstractSource {
        };
        $law = $source->getLaw();
        $anonymUserSource = new UserSource();
        EntityTemplateFactory::createStandartPublicRights($source);
        $requestedRight = new Right();
        $requestedRight->setReciever($anonymUserSource);
        $lawPermissionChecker = new LawPermissionChecker($law);
        foreach (LayerType::getValues() as $layerType) {
            foreach (ActionType::getValues() as $actionType) {
                $requestedRight->setActionType($actionType);
                $requestedRight->setLayer($layerType);
                $checkResult = $lawPermissionChecker->hasPermission($requestedRight);
                if (in_array($actionType, $allowedActions) && in_array($layerType, $allowedLayers)) {
                    $this->assertTrue($checkResult);
                } else {
                    $this->assertFalse($checkResult);
                }
            }
        }
    }
}
