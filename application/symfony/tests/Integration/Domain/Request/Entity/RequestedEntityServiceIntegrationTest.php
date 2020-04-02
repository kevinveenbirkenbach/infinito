<?php

namespace tests\Integration\Domain\Request\Entity;

use Infinito\Domain\Request\Entity\RequestedEntityServiceInterface;
use Infinito\Entity\Source\AbstractSource;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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
