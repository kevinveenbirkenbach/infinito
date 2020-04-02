<?php

namespace tests\Unit\Domain\Request\Right;

use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;
use Infinito\Domain\Repository\LayerRepositoryFactoryService;
use Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface;
use Infinito\Domain\Request\Entity\RequestedEntity;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Domain\Request\Right\RequestedRight;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Source\PureSource;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Exception\Collection\ContainsElementException;
use Infinito\Exception\Core\NoIdentityCoreException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
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
        $this->requestedRight->getLayer();
    }

    public function testRequestedEntityWithoutAttributes(): void
    {
        $requestedSource = $this->createMock(RequestedEntity::class);
        $this->requestedRight->setRequestedEntity($requestedSource);
        $this->expectException(NoIdentityCoreException::class);
        $this->requestedRight->getSource();
    }

    public function testKnownSource(): void
    {
        $requestedEntity = new RequestedEntity($this->layerRepositoryFactoryService);
        $requestedEntity->setSlug(ImpressumFixtureSource::getSlug());
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
        $slug = ImpressumFixtureSource::getSlug();
        $requestedEntityEntity = new PureSource();
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('getSlug')->willReturn($slug);
        $requestedEntity->method('hasSlug')->willReturn(true);
        $requestedEntity->method('hasIdentity')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($requestedEntityEntity);
        $this->assertEquals($slug, $requestedEntity->getSlug());
        $this->requestedRight->setRequestedEntity($requestedEntity);
        $responseSource1 = $this->requestedRight->getSource();
        $responseSource2 = $this->requestedRight->getSource();
        $this->assertEquals($responseSource1, $responseSource2);
    }

    public function testMetaEntity(): void
    {
        $slug = 123;
        $source = $this->createMock(SourceInterface::class);
        $entity = new Law();
        $entity->setSource($source);
        $requestedEntity = $this->createMock(RequestedEntityInterface::class);
        $requestedEntity->method('getSlug')->willReturn($slug);
        $requestedEntity->method('hasSlug')->willReturn(true);
        $requestedEntity->method('getEntity')->willReturn($entity);
        $requestedEntity->method('hasIdentity')->willReturn(true);
        $this->assertEquals($slug, $requestedEntity->getSlug());
        $this->requestedRight->setRequestedEntity($requestedEntity);
        $this->requestedRight->setLayer(LayerType::LAW);
        $responseSource1 = $this->requestedRight->getSource();
        $this->assertEquals($responseSource1, $source);
    }

    public function testSetActionType(): void
    {
        $attributType = ActionType::CREATE;
        $this->requestedRight->setActionType($attributType);
        $this->assertEquals($attributType, $this->requestedRight->getActionType());
        $this->expectException(ContainsElementException::class);
        $this->requestedRight->setActionType($attributType);
    }
}
