<?php

namespace tests\Integration\Domain\RequestManagement\Right;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Domain\RequestManagement\Right\RequestedRightServiceInterface;
use Infinito\DBAL\Types\Meta\Right\CRUDType;

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
        $this->assertNull($this->requestedRightService->setCrud($crud));
        $this->assertEquals($crud, $this->requestedRightService->getCrud());
    }
}
