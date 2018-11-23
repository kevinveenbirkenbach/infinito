<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use FOS\UserBundle\Util\PasswordUpdater;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * Never execute this fixture on a livesystem!
 *
 * @author kevinfrantz
 */
class DummyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->addTestUser();
        $manager->flush();
    }
    
    protected function addTestUser():void{
        /**
         * @var UserManager $userManager
         */
        $userManager = $this->container->get('fos_user.user_manager');
        /**
         * @var User $testUser
         */
        $testUser = $userManager->createUser();
        $testUser->setEmail("test@test.de");
        $testUser->setUsername("test");
        $testUser->setPlainPassword('test');
        $testUser->setEnabled(true);
        $userManager->updateUser($testUser);
    }
}
