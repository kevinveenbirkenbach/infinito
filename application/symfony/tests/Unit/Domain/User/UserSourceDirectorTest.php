<?php

namespace Tests\Unit\Domain\User;

use Infinito\Domain\Fixture\FixtureSource\GuestUserFixtureSource;
use Infinito\Domain\User\UserSourceDirector;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\User;
use Infinito\Repository\Source\SourceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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
        $this->assertEquals(GuestUserFixtureSource::getSlug(), $expectedUser->getSource()->getSlug());
    }

    public function testUser(): void
    {
        $origineUser = $this->createMock(User::class);
        $userIdentityManager = new UserSourceDirector($this->sourceRepository, $origineUser);
        $expectedUser = $userIdentityManager->getUser();
        $this->assertEquals($origineUser, $expectedUser);
    }
}
