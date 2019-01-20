<?php

namespace tests\Unit\Repository\Source;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\Source\SourceRepositoryInterface;
use App\Entity\Source\AbstractSource;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\SourceInterface;

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
        $requestedSource->method('getSlug')->willReturn(SystemSlugType::IMPRINT);
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
        $imprint = $this->sourceRepository->findOneBySlug(SystemSlugType::IMPRINT);
        $this->assertInstanceOf(SourceInterface::class, $imprint);
    }
}
