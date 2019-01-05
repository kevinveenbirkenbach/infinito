<?php

namespace Tests\Unit\Domain\SecureLoadManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use App\Entity\Source\AbstractSource;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Domain\SecureLoadManagement\SecureSourceLoader;
use App\Entity\Source\Primitive\Text\TextSource;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Meta\Right;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Primitive\Text\TextSourceInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 *
 * @todo Implement more tests
 */
class SecureSourceLoaderTest extends KernelTestCase
{
    /**
     * @var ObjectRepository
     */
    private $sourceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $this->setSourceRepository();
    }

    private function setSourceRepository(): void
    {
        $this->sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
    }

    public function testAccessDeniedException(): void
    {
        $requestedSource = new TextSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setType(CRUDType::READ);
        $requestedRight->setReciever(new UserSource());
        $secureSourceLoader = new SecureSourceLoader($this->entityManager, $requestedRight);
        $this->expectException(AccessDeniedHttpException::class);
        $secureSourceLoader->getSource();
    }

    public function testGranted(): void
    {
        $requestedSource = new TextSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setType(CRUDType::READ);
        $requestedRight->setReciever($this->sourceRepository->findOneBySlug(SystemSlugType::GUEST_USER));
        $secureSourceLoader = new SecureSourceLoader($this->entityManager, $requestedRight);
        $this->assertInstanceOf(TextSourceInterface::class, $secureSourceLoader->getSource());
    }
}
