<?php

namespace Tests\Unit\Domain\UserManagement;

use App\Domain\UserManagement\UserIdentityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\DBAL\Types\SystemSlugType;
use App\Entity\User;

class UserIdentityManagerTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$container->get('doctrine.orm.default_entity_manager');
    }

    public function testGuestUser(): void
    {
        $origineUser = null;
        $userIdentityManager = new UserIdentityManager($this->entityManager, $origineUser);
        $expectedUser = $userIdentityManager->getUser();
        $this->assertEquals(SystemSlugType::GUEST_USER, $expectedUser->getSource()->getSlug());
    }

    public function testUser(): void
    {
        $origineUser = new User();
        $userIdentityManager = new UserIdentityManager($this->entityManager, $origineUser);
        $expectedUser = $userIdentityManager->getUser();
        $this->assertEquals($origineUser, $expectedUser);
    }
}
