<?php

namespace tests\Integration\Domain\RequestManagement\Right;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Domain\RequestManagement\User\RequestedUserServiceInterface;

/**
 * @author kevinfrantz
 */
class RequestedUserServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var RequestedUserServiceInterface
     */
    private $requestedUserService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->requestedUserService = self::$container->get(RequestedUserServiceInterface::class);
    }

    public function testCrudAccessors(): void
    {
        $crud = CRUDType::READ;
        $this->assertNull($this->requestedUserService->setCrud($crud));
        $this->assertEquals($crud, $this->requestedUserService->getCrud());
    }
}
