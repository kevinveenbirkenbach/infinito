<?php

namespace Integration\Entity\Source;

use Doctrine\ORM\EntityManagerInterface;
use Infinito\Entity\Source\PureSource;
use Infinito\Entity\Source\PureSourceInterface;
use Infinito\Repository\Source\SourceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
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
        $this->assertNull($this->pureSource->getId());
    }
}
