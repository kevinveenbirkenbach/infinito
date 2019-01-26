<?php

namespace tests\Unit\Domain\RepositoryManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use App\Repository\RepositoryInterface;
use App\Exception\NotSetException;
use App\Domain\LayerManagement\LayerClassMap;

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
        $this->expectException(NotSetException::class);
        $repositoy = $this->layerRepositoryFactoryService->getRepository('UnknownLayer');
    }
}
