<?php

namespace tests\Unit\Domain\RequestManagement\Entity;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Domain\RequestManagement\Entity\LazyRequestedEntity;
use Infinito\Domain\Repository\LayerRepositoryFactoryServiceInterface;
use Infinito\Repository\RepositoryInterface;
use Infinito\Entity\Source\PureSource;
use Infinito\Repository\Source\SourceRepositoryInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;

class LazyRequestedEntityTest extends TestCase
{
    /**
     * @var RequestedEntityInterface
     */
    private $lazyRequestedEntity;

    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    /**
     * @var SourceRepositoryInterface
     */
    private $repository;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->repository = $this->createMock(SourceRepositoryInterface::class);
        $this->layerRepositoryFactoryService = new class($this->repository) implements LayerRepositoryFactoryServiceInterface {
            private $count = 0;
            private $repository;

            public function __construct($repository)
            {
                $this->repository = $repository;
            }

            public function getRepository(string $layer): RepositoryInterface
            {
                if ($this->count > 0) {
                    //Just for information and testing thrown
                    throw new \Exception('The function '.__FUNCTION__.' was called multiple times!');
                }
                ++$this->count;

                return $this->repository;
            }
        };
        $this->lazyRequestedEntity = new LazyRequestedEntity($this->layerRepositoryFactoryService);
    }

    public function testSlug(): void
    {
        $slug = 'hello';
        $requestedSource = new PureSource();
        $requestedSource->setSlug($slug);
        $requestedSource->setId('123');
        $this->repository->method('findOneBySlug')->willReturn($requestedSource);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getLayer')->willReturn(LayerType::SOURCE);
        $this->assertNull($this->lazyRequestedEntity->setRequestedRight($requestedRight));
        $this->assertNull($this->lazyRequestedEntity->setSlug($slug));
        //Call 1
        $this->assertEquals($requestedSource, $this->lazyRequestedEntity->getEntity());
        //Call 2
        $this->assertEquals($requestedSource, $this->lazyRequestedEntity->getEntity());
        //Call with other slug
        $this->assertNull($this->lazyRequestedEntity->setSlug('abcde'));
        $this->expectException(\Exception::class);
        $this->lazyRequestedEntity->getEntity();
    }

    public function testId(): void
    {
        $id = 12345;
        $requestedSource = new PureSource();
        $requestedSource->setId($id);
        $this->repository->method('find')->willReturn($requestedSource);
        $requestedRight = $this->createMock(RequestedRightInterface::class);
        $requestedRight->method('getLayer')->willReturn(LayerType::SOURCE);
        $this->assertNull($this->lazyRequestedEntity->setRequestedRight($requestedRight));
        $this->assertNull($this->lazyRequestedEntity->setId($id));
        //Call 1
        $this->assertEquals($requestedSource, $this->lazyRequestedEntity->getEntity());
        //Call 2
        $this->assertEquals($requestedSource, $this->lazyRequestedEntity->getEntity());
        //Call with other slug
        $this->assertNull($this->lazyRequestedEntity->setId(65432));
        $this->expectException(\Exception::class);
        $this->lazyRequestedEntity->getEntity();
    }
}
