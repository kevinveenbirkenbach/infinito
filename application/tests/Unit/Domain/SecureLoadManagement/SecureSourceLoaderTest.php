<?php

namespace Tests\Unit\Domain\SecureLoadManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use App\Entity\Source\AbstractSource;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Domain\SecureLoadManagement\SecureSourceLoader;
use App\Entity\Source\Primitive\Text\TextSource;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Meta\Right;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Primitive\Text\TextSourceInterface;

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

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->setSourceRepository($kernel);
    }

    private function setSourceRepository(KernelInterface $kernel): void
    {
        $this->sourceRepository = $kernel->getContainer()
        ->get('doctrine')
        ->getManager()->getRepository(AbstractSource::class);
    }

    public function testAccessDeniedException(): void
    {
        $requestedSource = new TextSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setType(RightType::READ);
        $requestedRight->setReciever(new UserSource());
        $secureSourceLoader = new SecureSourceLoader($this->sourceRepository, $requestedRight);
        $this->expectException(AccessDeniedHttpException::class);
        $secureSourceLoader->getSource();
    }

//     public function testGranted(): void
//     {
//         $requestedSource = new TextSource();
//         $requestedSource->setSlug(SystemSlugType::IMPRINT);
//         $requestedRight = new Right();
//         $requestedRight->setSource($requestedSource);
//         $requestedRight->setLayer(LayerType::SOURCE);
//         $requestedRight->setType(RightType::READ);
//         $requestedRight->setReciever($this->sourceRepository->findOneBy(['slug' => SystemSlugType::GUEST_USER]));
//         $secureSourceLoader = new SecureSourceLoader($this->sourceRepository, $requestedRight);
//         $this->assertInstanceOf(TextSourceInterface::class, $secureSourceLoader->getSource());
//     }
}
