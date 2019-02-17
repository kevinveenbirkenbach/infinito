<?php

namespace Tests\Unit\Domain\UserManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\DBAL\Types\SystemSlugType;
use Infinito\Entity\User;
use Infinito\Domain\UserManagement\UserSourceDirector;
use Infinito\Repository\Source\SourceRepository;
use Infinito\Entity\Source\AbstractSource;

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
