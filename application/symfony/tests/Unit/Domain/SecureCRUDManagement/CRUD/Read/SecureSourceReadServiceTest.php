<?php

namespace tests\Unit\Domain\SecureCRUDManagement\CRUD\Read;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Entity\Source\Primitive\Text\TextSource;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Meta\Right;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Primitive\Text\TextSourceInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\SecureCRUDManagement\CRUD\Read\SecureSourceReadService;
use Symfony\Component\Security\Core\Security;

/**
 * @author kevinfrantz
 *
 * @todo Implement more tests
 */
class SecureSourceReadServiceTest extends KernelTestCase
{
    /**
     * @var ObjectRepository
     */
    private $sourceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SecureSourceReadService
     */
    private $secureSourceReadService;

    public function setUp(): void
    {
        self::bootKernel();
        $requestStack = self::$container->get('request_stack');
        $security = new Security(self::$kernel->getContainer());
        $entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $this->secureSourceReadService = new SecureSourceReadService($requestStack, $security, $entityManager);
    }

    public function testAccessDeniedException(): void
    {
        $requestedSource = new TextSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setCrud(CRUDType::READ);
        $requestedRight->setReciever(new UserSource());
        $this->expectException(AccessDeniedHttpException::class);
        $this->secureSourceReadService->read($requestedRight);
    }

    public function testGranted(): void
    {
        $requestedSource = new TextSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setCrud(CRUDType::READ);
        $requestedRight->setReciever($this->sourceRepository->findOneBySlug(SystemSlugType::GUEST_USER));
        $textSourceResponse = $this->secureSourceReadService->read($requestedRight);
        $this->assertInstanceOf(TextSourceInterface::class, $textSourceResponse);
    }
}
