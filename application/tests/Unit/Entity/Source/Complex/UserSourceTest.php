<?php

namespace tests\unit\Entity\Source\Complex;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Complex\UserSourceInterface;
use App\Entity\Source\Complex\UserSource;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Complex\PersonIdentitySourceInterface;

class UserSourceTest extends TestCase
{
    /**
     * @var UserSourceInterface
     */
    public $userSource;

    public function setUp(): void
    {
        $this->userSource = new UserSource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->userSource->getMemberships());
        $this->assertInstanceOf(PersonIdentitySourceInterface::class, $this->userSource->getPersonIdentitySource());
        $this->expectException(\TypeError::class);
        $this->userSource->getUser();
    }
}