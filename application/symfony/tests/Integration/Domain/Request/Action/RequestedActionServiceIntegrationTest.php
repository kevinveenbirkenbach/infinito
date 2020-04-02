<?php

namespace tests\Integration\Domain\Request\Action;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Request\Action\RequestedActionServiceInterface;
use Infinito\Domain\Request\Entity\LazyRequestedEntity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kevinfrantz
 */
class RequestedActionServiceIntegrationTest extends KernelTestCase
{
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
        $this->requestedActionService = self::$container->get(RequestedActionServiceInterface::class);
    }

    public function testActionAccessors(): void
    {
        $actionType = ActionType::EXECUTE;
        $this->assertNull($this->requestedActionService->setActionType($actionType));
        $this->assertEquals($actionType, $this->requestedActionService->getActionType());
    }

    public function testLazyRequestedEntity(): void
    {
        $this->assertInstanceOf(LazyRequestedEntity::class, $this->requestedActionService->getRequestedEntity());
    }
}
