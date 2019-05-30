<?php

namespace tests\Unit\Repository\Source;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Repository\Source\SourceRepositoryInterface;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;

/**
 * @author kevinfrantz
 */
class SourceRepositoryTest extends KernelTestCase
{
    /**
     * @var SourceRepositoryInterface
     */
    protected $sourceRepository;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()
        ->get('doctrine')
        ->getManager();
        $this->sourceRepository = $entityManager->getRepository(AbstractSource::class);
    }

    public function testLoadBySlugOrId(): void
    {
        $requestedSource = $this->createMock(RequestedEntityInterface::class);
        $requestedSource->method('hasSlug')->willReturn(true);
        $requestedSource->method('getSlug')->willReturn(ImpressumFixtureSource::getSlug());
        $imprint = $this->sourceRepository->findOneByIdOrSlug($requestedSource);
        $this->assertInstanceOf(SourceInterface::class, $imprint);
        $requestedSource2 = $this->createMock(RequestedEntityInterface::class);
        $requestedSource2->method('hasId')->willReturn(true);
        $requestedSource2->method('getId')->willReturn($imprint->getId());
        $imprint2 = $this->sourceRepository->findOneByIdOrSlug($requestedSource2);
        $this->assertInstanceOf(SourceInterface::class, $imprint2);
    }

    public function testLoadBySlug(): void
    {
        $imprint = $this->sourceRepository->findOneBySlug(ImpressumFixtureSource::getSlug());
        $this->assertInstanceOf(SourceInterface::class, $imprint);
    }
}
