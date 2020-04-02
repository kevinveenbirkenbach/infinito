<?php

namespace tests\Integration\Domain\Request\Right;

use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Domain\Request\Right\RequestedRightServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kevinfrantz
 */
class RequestedRightServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var RequestedRightServiceInterface
     */
    private $requestedRightService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->requestedRightService = self::$container->get(RequestedRightServiceInterface::class);
    }

    public function testClassAccessors(): void
    {
        $crud = CRUDType::READ;
        $this->assertNull($this->requestedRightService->setActionType($crud));
        $this->assertEquals($crud, $this->requestedRightService->getActionType());
    }
}
