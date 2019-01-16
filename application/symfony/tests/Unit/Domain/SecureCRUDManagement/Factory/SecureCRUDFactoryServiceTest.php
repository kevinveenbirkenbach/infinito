<?php

namespace tests\Unit\Domain\SecureCRUDManagement\Factory;

use App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Security;
use App\Domain\SecureCRUDManagement\Factory\SecureCRUDFactoryService;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Entity\Meta\Right;
use App\Domain\SecureCRUDManagement\CRUD\SecureCRUDServiceInterface;
use App\DBAL\Types\Meta\Right\CRUDType;

/**
 * @author kevinfrantz
 */
class SecureCRUDFactoryServiceTest extends KernelTestCase
{
    const EXCLUDED_TYPES = [
        CRUDType::CREATE => [
            LayerType::LAW,
        ],
        CRUDType::DELETE => [
            LayerType::LAW,
        ],
        CRUDType::READ => [],
        CRUDType::UPDATE => [],
    ];

    /**
     * @var SecureCRUDFactoryServiceInterface
     */
    private $secureCRUDFactoryService;

    public function setUp(): void
    {
        self::bootKernel();
        $requestStack = self::$container->get('request_stack');
        $security = new Security(self::$kernel->getContainer());
        $entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $this->secureCRUDFactoryService = new SecureCRUDFactoryService($requestStack, $security, $entityManager);
    }

    public function testCreate(): void
    {
        foreach (CRUDType::getChoices() as $crud) {
            foreach (LayerType::getChoices() as $layer) {
                if (!in_array($layer, self::EXCLUDED_TYPES[$crud])) {
                    $requestedRight = new Right();
                    $requestedRight->setLayer($layer);
                    $requestedRight->setCrud($crud);
                    $secureCreator = $this->secureCRUDFactoryService->create($requestedRight);
                    $this->assertInstanceOf(SecureCRUDServiceInterface::class, $secureCreator);
                }
            }
        }
    }
}
