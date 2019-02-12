<?php

namespace Tests\Integration\DataFixtures;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\Source\AbstractSource;
use App\Entity\Source\Complex\UserSourceInterface;
use App\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use App\Domain\FixtureManagement\FixtureSource\GuestUserFixtureSource;

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
        $imprint = $sourceRepository->findOneBySlug(ImpressumFixtureSource::SLUG);
        $this->assertInternalType('string', $imprint->getText());
    }

    public function testGuestUserSource(): void
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $userSource = $sourceRepository->findOneBySlug(GuestUserFixtureSource::SLUG);
        $this->assertInstanceOf(UserSourceInterface::class, $userSource);
    }
}
