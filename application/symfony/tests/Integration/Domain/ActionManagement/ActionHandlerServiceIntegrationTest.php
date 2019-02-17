<?php

namespace tests\Integration\Domain\ActionManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use Infinito\Entity\Source\SourceInterface;
use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
class ActionHandlerServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var ActionHandlerServiceInterface
     */
    private $actionHandlerService;

    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->actionHandlerService = self::$container->get(ActionHandlerServiceInterface::class);
        $this->requestedActionService = self::$container->get(RequestedActionServiceInterface::class);
    }

    public function testEnityManager(): void
    {
        $this->requestedActionService->getRequestedEntity()->setSlug(ImpressumFixtureSource::SLUG);
        $this->requestedActionService->setActionType(ActionType::READ);
        $this->requestedActionService->setLayer(LayerType::SOURCE);
        $this->assertInstanceOf(SourceInterface::class, $this->actionHandlerService->handle());
    }
}
