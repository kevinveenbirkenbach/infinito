<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

/**
 * Never execute this fixture on a livesystem!
 *
 * @author kevinfrantz
 */
class DummyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    }

    public function adminUser()
    {
        $admin = new User();
        $source = $admin->getSource();
    }
}
