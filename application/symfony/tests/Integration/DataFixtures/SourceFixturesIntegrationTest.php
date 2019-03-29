<?php

namespace Tests\Integration\DataFixtures;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\Source\Complex\UserSourceInterface;
use Infinito\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use Infinito\Domain\FixtureManagement\FixtureSource\GuestUserFixtureSource;

class SourceFixturesIntegrationTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testImpressumSource(): void
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $imprint = $sourceRepository->findOneBySlug(ImpressumFixtureSource::getSlug());
        $this->assertInternalType('string', $imprint->getText());
    }

    public function testGuestUserSource(): void
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $userSource = $sourceRepository->findOneBySlug(GuestUserFixtureSource::getSlug());
        $this->assertInstanceOf(UserSourceInterface::class, $userSource);
    }
}
