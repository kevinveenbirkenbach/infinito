<?php

namespace tests\unit\Entity\Source\Combination;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Data\UserSourceInterface;
use App\Entity\Source\Data\UserSource;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Data\PersonIdentitySourceInterface;

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
        $this->assertInstanceOf(PersonIdentitySourceInterface::class, $this->userSource->getIdentitySource());
        $this->expectException(\TypeError::class);
        $this->userSource->getUser();
    }
}
