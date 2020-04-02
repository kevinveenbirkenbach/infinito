<?php

namespace tests\Integration\Domain\Request\Right;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface;
use Infinito\Repository\Meta\LawRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kevinfrantz
 */
class LayerRepositoryFactoryServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->layerRepositoryFactoryService = self::$container->get(LayerRepositoryFactoryServiceInterface::class);
    }

    public function testLayer(): void
    {
        $layer = LayerType::LAW;
        $this->assertInstanceOf(LawRepository::class, $this->layerRepositoryFactoryService->getRepository($layer));
    }
}
