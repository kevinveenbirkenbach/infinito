<?php

namespace tests\Unit\Domain\SecureCRUDManagement\Factory;

use PHPUnit\Framework\TestCase;
use App\Domain\SecureCRUDManagement\Factory\AbstractSecureCRUDFactoryService;
use App\Entity\Meta\RightInterface;
use App\Domain\SecureCRUDManagement\CRUD\Create\SecureCreatorInterface;

/**
 * @author kevinfrantz
 */
class AbstractSecureCRUDFactoryServiceTest extends TestCase
{
    public function testGetCRUDNamespace(): void
    {
        $abstractSecureCRUDFactoryService = new class() extends AbstractSecureCRUDFactoryService {
            public function __construct()
            {
            }

            public function publicGetCRUDNamespace(string $layer, string $crud): string
            {
                return $this->getCRUDNamespace($layer, $crud);
            }

            public function create(RightInterface $requestedRight): SecureCreatorInterface
            {
            }
        };
        $result = $abstractSecureCRUDFactoryService->publicGetCRUDNamespace('Layer', 'Crud');
        $this->assertEquals('App\\Domain\\SecureCRUDManagement\\CRUD\\Crud\\SecureLayerCrud', $result);
    }
}
