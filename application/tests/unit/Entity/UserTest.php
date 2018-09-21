<?php
namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Law;
use App\Entity\UserSource;
use App\Entity\Node;

/**
 *
 * @author kevinfrantz
 */
class UserTest extends TestCase
{

    const PASSWORD = '12345678';

    const USERNAME = 'tester';

    /**
     *
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function testUsername(): void
    {
        $this->user->setUsername(self::USERNAME);
        $this->assertEquals(self::USERNAME, $this->user->getUsername());
    }

    public function testPassword(): void
    {
        $this->user->setPassword(self::PASSWORD);
        $this->assertEquals(self::PASSWORD, $this->user->getPassword());
    }
    
    public function testSource(): void
    {
        $this->assertInstanceOf(UserSource::class,$this->user->getSource());
    }
    
    public function testNode(): void
    {
        $this->assertInstanceOf(Node::class,$this->user->getSource()->getNode());
    }

    public function testLaw(): void
    {
        $this->assertInstanceOf(Law::class,$this->user->getSource()->getNode()->getLaw());
    }
}
