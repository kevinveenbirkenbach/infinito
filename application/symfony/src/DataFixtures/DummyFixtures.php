<?php

namespace Infinito\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Doctrine\UserManager;
use Infinito\Entity\User;
use Infinito\Entity\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Never execute this fixture on a livesystem!
 *
 * @author kevinfrantz
 */
class DummyFixtures extends Fixture implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public const USER_NAME = 'test';

    public const USER_EMAIL = 'test@test.de';

    public const USER_PASSWORD = 'test';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $manager->persist($this->getTestUser());
        $manager->flush();
    }

    protected function getTestUser(): UserInterface
    {
        /**
         * @var UserManager
         */
        $userManager = $this->container->get('fos_user.user_manager');
        /**
         * @var User
         */
        $testUser = $userManager->createUser();
        $testUser->setEmail(self::USER_EMAIL);
        $testUser->setUsername(self::USER_NAME);
        $testUser->setPlainPassword(self::USER_PASSWORD);
        $testUser->setEnabled(true);
        $userManager->updateUser($testUser);

        return $testUser;
    }
}
