<?php

namespace tests\Integration\Domain\RequestManagement\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\RequestManagement\Entity\RequestedEntityServiceInterface;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 */
class RequestedEntityServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var RequestedEntityServiceInterface
     */
    private $requestedEntityService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->requestedEntityService = self::$container->get(RequestedEntityServiceInterface::class);
    }

    public function testClassAccessors(): void
    {
        $class = AbstractSource::class;
        $this->assertNull($this->requestedEntityService->setClass($class));
        $this->assertEquals($class, $this->requestedEntityService->getClass());
    }
}
