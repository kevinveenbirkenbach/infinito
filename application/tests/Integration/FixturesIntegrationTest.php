<?php

namespace Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\Source\AbstractSource;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\Primitive\Text\TextSourceInterface;

class FixturesIntegrationTest extends KernelTestCase
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

    public function testImpressum(): void
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        /**
         * @var TextSourceInterface
         */
        $imprint = $sourceRepository->findOneBy(['slug' => SystemSlugType::IMPRINT]);
        $this->assertInternalType('string', $imprint->getText());
    }
}
