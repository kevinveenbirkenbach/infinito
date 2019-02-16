<?php

namespace tests\Integration\Domain\RequestManagement\Action;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use App\DBAL\Types\ActionType;

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
        $actionType = ActionType::THREAD;
        $this->assertNull($this->requestedActionService->setActionType($actionType));
        $this->assertEquals($actionType, $this->requestedActionService->getActionType());
    }
}
