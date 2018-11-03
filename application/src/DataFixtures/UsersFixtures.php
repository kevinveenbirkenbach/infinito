<?php
namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
    }

    public function adminUser(){
        $admin = new User();
        $admin->getSource();
    }

}