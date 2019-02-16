<?php

namespace tests\Integration\Domain\ActionManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\ActionManagement\ActionHandlerServiceInterface;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use App\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use App\Entity\Source\SourceInterface;
use App\DBAL\Types\ActionType;
use App\DBAL\Types\Meta\Right\LayerType;

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
