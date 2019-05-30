<?php

namespace tests\Unit\Domain\RepositoryManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use Infinito\Repository\RepositoryInterface;
use Infinito\Domain\Layer\LayerClassMap;
use Infinito\Exception\Collection\NotSetElementException;

/**
 * @author kevinfrantz
 */
class LayerRepositoryFactoryServiceTest extends KernelTestCase
{
    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    public function setUp(): void
    {
        self::bootKernel();
        $entityManager = self::$container->get('doctrine')->getManager();
        $this->layerRepositoryFactoryService = new LayerRepositoryFactoryService($entityManager);
    }

    public function testGetRepository(): void
    {
        foreach (array_keys(LayerClassMap::LAYER_CLASS_MAP) as $layer) {
            $repositoy = $this->layerRepositoryFactoryService->getRepository($layer);
            $this->assertInstanceOf(RepositoryInterface::class, $repositoy);
        }
        $this->expectException(NotSetElementException::class);
        $repositoy = $this->layerRepositoryFactoryService->getRepository('UnknownLayer');
    }
}
