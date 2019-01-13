<?php

namespace Tests\Unit\Domain\UserManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\DBAL\Types\SystemSlugType;
use App\Entity\User;
use App\Domain\UserManagement\UserSourceDirector;
use App\Repository\Source\SourceRepository;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 */
class UserSourceDirectorTest extends KernelTestCase
{
    /**
     * @var SourceRepository
     */
    private $sourceRepository;

    public function setUp(): void
    {
        self::bootKernel();
        $this->sourceRepository = self::$container->get('doctrine.orm.default_entity_manager')->getRepository(AbstractSource::class);
    }

    public function testGuestUser(): void
    {
        $origineUser = null;
        $userIdentityManager = new UserSourceDirector($this->sourceRepository, $origineUser);
        $expectedUser = $userIdentityManager->getUser();
        $this->assertEquals(SystemSlugType::GUEST_USER, $expectedUser->getSource()->getSlug());
    }

    public function testUser(): void
    {
        $origineUser = $this->createMock(User::class);
        $userIdentityManager = new UserSourceDirector($this->sourceRepository, $origineUser);
        $expectedUser = $userIdentityManager->getUser();
        $this->assertEquals($origineUser, $expectedUser);
    }
}
