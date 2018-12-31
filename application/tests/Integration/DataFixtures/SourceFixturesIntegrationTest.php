<?php

namespace Tests\Integration\DataFixtures;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\Source\AbstractSource;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\Complex\UserSourceInterface;

class SourceFixturesIntegrationTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testImpressumSource(): void
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $imprint = $sourceRepository->findOneBy(['slug' => SystemSlugType::IMPRINT]);
        $this->assertInternalType('string', $imprint->getText());
    }

    public function testGuestUserSource(): void
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $userSource = $sourceRepository->findOneBy(['slug' => SystemSlugType::GUEST_USER]);
        $this->assertInstanceOf(UserSourceInterface::class, $userSource);
    }
}
