<?php

namespace App\Tests\Unit\Entity\Meta;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\Reciever;
use App\Entity\Meta\RecieverInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\Data\UserSource;
use App\Entity\Source\Collection\TreeCollectionSource;
use App\Entity\Source\Collection\TreeCollectionSourceInterface;
use App\Entity\Source\Data\UserSourceInterface;

class RecieverTest extends TestCase
{
    /**
     * @var RecieverInterface
     */
    public $reciever;

    public function setUp(): void
    {
        $this->reciever = new Reciever();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->reciever->getMembers());
        $this->expectException(\TypeError::class);
        $this->reciever->getRight();
    }

    public function testMembersIncludingChildren(): void
    {
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject|UserSourceInterface
         */
        $user1 = $this->createMock(UserSource::class);
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject|UserSourceInterface
         */
        $user2 = $this->createMock(UserSource::class);
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject|UserSourceInterface
         */
        $user3 = $this->createMock(UserSource::class);
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject|TreeCollectionSourceInterface
         */
        $group1 = $this->createMock(TreeCollectionSource::class);
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject|TreeCollectionSourceInterface
         */
        $group2 = $this->createMock(TreeCollectionSource::class);
        /**
         * @var \PHPUnit\Framework\MockObject\MockObject|TreeCollectionSourceInterface
         */
        $group3 = $this->createMock(TreeCollectionSource::class);
        $group1->getCollection()->add($user1);
        $group2->getCollection()->add($group1);
        $group2->getCollection()->add($user2);
        $group2->getCollection()->add($user3);
        $group2->getCollection()->add($group3);
        $this->reciever->getMembers()->add($group1);
        $this->assertEquals(6, $this->reciever->getMembersIncludingChildren()->count());
    }
}
