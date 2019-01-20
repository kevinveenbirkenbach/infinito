<?php

namespace tests\Unit\Domain\RepositoryManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use App\Repository\RepositoryInterface;

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
        foreach (LayerRepositoryFactoryService::LAYER_CLASS_MAP as $layer => $class) {
            $repositoy = $this->layerRepositoryFactoryService->getRepository($layer);
            $this->assertInstanceOf(RepositoryInterface::class, $repositoy);
        }
    }
}
