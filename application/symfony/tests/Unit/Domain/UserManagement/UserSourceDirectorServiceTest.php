<?php

namespace tests\Unit\Domain\UserManagement;

use App\Domain\UserManagement\UserSourceDirectorInterface;
use App\Domain\UserManagement\UserSourceDirectorService;
use App\Entity\User;
use App\Entity\Source\SourceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Security;

/**
 * @author kevinfrantz
 */
class UserSourceDirectorServiceTest extends KernelTestCase
{
    /**
     * @var UserSourceDirectorInterface
     */
    private $userSourceDirectorService;

    public function setUp(): void
    {
        self::bootKernel();
        $container = self::$container;
        $security = new Security($container);
        $entityManager = $container->get('doctrine.orm.default_entity_manager');
        $this->userSourceDirectorService = new UserSourceDirectorService($entityManager, $security);
    }

    public function testGuestUser(): void
    {
        $user = $this->userSourceDirectorService->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(SourceInterface::class, $user->getSource());
    }
}
