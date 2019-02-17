<?php

namespace Infinito\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Infinito\Entity\User;
use FOS\UserBundle\Doctrine\UserManager;
use Infinito\Entity\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Never execute this fixture on a livesystem!
 *
 * @author kevinfrantz
 */
class DummyFixtures extends Fixture implements ContainerAwareInterface
{
    private $container;

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
        $testUser->setEmail('test@test.de');
        $testUser->setUsername('test');
        $testUser->setPlainPassword('test');
        $testUser->setEnabled(true);
        $userManager->updateUser($testUser);

        return $testUser;
    }
}
