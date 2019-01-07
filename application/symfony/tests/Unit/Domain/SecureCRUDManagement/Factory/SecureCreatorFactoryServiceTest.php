<?php

namespace tests\Unit\Domain\SecureCRUDManagement\Factory;

use App\Domain\SecureCRUDManagement\Factory\SecureCreatorFactoryServiceInterface;
use App\Domain\SecureCRUDManagement\Factory\SecureCreatorFactoryService;
use Symfony\Component\Security\Core\Security;
use App\DBAL\Types\Meta\Right\LayerType;
use App\Entity\Meta\Right;
use App\Domain\SecureCRUDManagement\CRUD\Create\SecureCreatorInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kevinfrantz
 */
class SecureCreatorFactoryServiceTest extends KernelTestCase
{
    /**
     * @var SecureCreatorFactoryServiceInterface
     */
    private $secureCreatorFactoryService;

    public function setUp(): void
    {
        self::bootKernel();
        $requestStack = self::$container->get('request_stack');
        $security = new Security(self::$kernel->getContainer());
        $this->secureCreatorFactoryService = new SecureCreatorFactoryService($requestStack, $security);
    }

    public function testCreate(): void
    {
        $excludedTypes = [
            LayerType::LAW,
        ];
        foreach (LayerType::getChoices() as $layer) {
            if (!in_array($layer, $excludedTypes)) {
                $requestedRight = new Right();
                $requestedRight->setLayer($layer);
                $secureCreator = $this->secureCreatorFactoryService->create($requestedRight);
                $this->assertInstanceOf(SecureCreatorInterface::class, $secureCreator);
            }
        }
    }
}
