<?php

namespace Integration\Entity\Source;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\Source\SourceRepository;
use App\Entity\Source\PureSourceInterface;
use App\Entity\Source\PureSource;

/**
 * @author kevinfrantz
 */
class PureSourceIntegrationTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SourceRepository
     */
    private $sourceRepository;

    /**
     * @var PureSourceInterface
     */
    private $pureSource;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $this->sourceRepository = $this->entityManager->getRepository(PureSource::class);
        $this->pureSource = new PureSource();
    }

    public function testDatabaseProcess(): void
    {
        $this->entityManager->persist($this->pureSource);
        $this->entityManager->flush();
        $this->assertGreaterThan(0, $this->pureSource->getId());
        $this->entityManager->remove($this->pureSource);
        $this->entityManager->flush();
        $this->expectException(\TypeError::class);
        $this->pureSource->getId();
    }
}
