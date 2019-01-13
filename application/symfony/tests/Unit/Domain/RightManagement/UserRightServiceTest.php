<?php
namespace tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Source\SourceInterface;
use App\Domain\RightManagement\UserRightService;

/**
 * 
 * @author kevinfrantz
 *
 */
class UserRightServiceTest extends TestCase
{
    public function testUserSet():void{
        $user = new User();
        $source = $this->createMock(SourceInterface::class);
        $user->setSource($source);
        $userRight = new UserRightService($user);
        $this->assertEquals($source, $userRight->getReciever());
    }
    
}

