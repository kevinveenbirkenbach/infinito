<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Domain\RequestManagement\Right\RequestedRight;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Domain\RequestManagement\Entity\RequestedEntity;
use App\DBAL\Types\SystemSlugType;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Exception\PreconditionFailedException;
use App\Entity\Source\PureSource;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author kevinfrantz
 */
class RequestedRightTest extends KernelTestCase
{
    /**
     * @var RequestedRightInterface
     */
    private $requestedRight;

    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    public function setUp(): void
    {
        self::bootKernel();
        $entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $this->layerRepositoryFactoryService = new LayerRepositoryFactoryService($entityManager);
        $this->requestedRight = new RequestedRight();
    }

    public function testLayer(): void
    {
        $layer = LayerType::SOURCE;
        $this->assertNull($this->requestedRight->setLayer($layer));
        $this->assertEquals($layer, $this->requestedRight->getLayer());
    }

    public function testLayerException(): void
    {
        $this->expectException(\TypeError::class);
        var_dump($this->requestedRight->getLayer());
    }

    public function testRequestedEntityWithoutAttributes(): void
    {
        $requestedSource = $this->createMock(RequestedEntity::class);
        $this->requestedRight->setRequestedEntity($requestedSource);
        $this->expectException(PreconditionFailedException::class);
        $this->requestedRight->getSource();
    }

    public function testKnownSource(): void
    {
        $requestedEntity = new RequestedEntity($this->layerRepositoryFactoryService);
        $requestedEntity->setSlug(SystemSlugType::IMPRINT);
        $this->requestedRight->setRequestedEntity($requestedEntity);
        $this->requestedRight->setLayer(LayerType::SOURCE);
        $sourceResponse1 = $this->requestedRight->getSource();
        $this->assertGreaterThan(0, $sourceResponse1->getId());
        $requestedEntity->setSlug('');
        $this->expectException(NotFoundHttpException::class);
        $this->requestedRight->getSource();
    }

    public function testEqualsSlug(): void
    {
        $slug = SystemSlugType::IMPRINT;
        $requestedEntityEntity = new PureSource();
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('getSlug')->willReturn($slug);
        $requestedEntity->method('hasSlug')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($requestedEntityEntity);
        $this->assertEquals($slug, $requestedEntity->getSlug());
        $this->requestedRight->setRequestedEntity($requestedEntity);
        $responseSource1 = $this->requestedRight->getSource();
        $responseSource2 = $this->requestedRight->getSource();
        $this->assertEquals($responseSource1, $responseSource2);
    }
}
