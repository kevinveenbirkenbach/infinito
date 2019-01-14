<?php

namespace tests\Unit\Domain\RightManagement\RightRequestManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\RightManagement\RightRequestManagement\RequestedRightInterface;
use App\Domain\RightManagement\RightRequestManagement\RequestedRight;
use App\Entity\Source\AbstractSource;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Domain\SourceManagement\RequestedSource;
use App\DBAL\Types\SystemSlugType;
use App\Domain\SourceManagement\RequestedSourceInterface;
use App\Exception\PreconditionFailedException;
use App\Exception\NotSetException;

/**
 * @author kevinfrantz
 */
class RequestedRightTest extends KernelTestCase
{
    /**
     * @var RequestedRightInterface
     */
    private $requestedRight;

    public function setUp(): void
    {
        self::bootKernel();
        $entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $sourceRepository = $entityManager->getRepository(AbstractSource::class);
        $this->requestedRight = new RequestedRight($sourceRepository);
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

    public function testRequestedSourceWithoutAttributes(): void
    {
        $requestedSource = $this->createMock(RequestedSource::class);
        $this->requestedRight->setRequestedSource($requestedSource);
        $this->expectException(PreconditionFailedException::class);
        $this->requestedRight->getSource();
    }

    public function testKnownSource(): void
    {
        $requestedSource = new RequestedSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $this->requestedRight->setRequestedSource($requestedSource);
        $sourceResponse1 = $this->requestedRight->getSource();
        $this->assertGreaterThan(0, $sourceResponse1->getId());
        $requestedSource->setSlug('');
        $this->expectException(NotSetException::class);
        $this->requestedRight->getSource();
    }

    public function testEqualsSlug(): void
    {
        $slug = SystemSlugType::IMPRINT;
        $requestedSource = $this->createMock(RequestedSourceInterface::class);
        $requestedSource->method('getSlug')->willReturn($slug);
        $requestedSource->method('hasSlug')->willReturn(true);
        $this->assertEquals($slug, $requestedSource->getSlug());
        $this->requestedRight->setRequestedSource($requestedSource);
        $responseSource1 = $this->requestedRight->getSource();
        $responseSource2 = $this->requestedRight->getSource();
        $this->assertEquals($responseSource1, $responseSource2);
    }
}
