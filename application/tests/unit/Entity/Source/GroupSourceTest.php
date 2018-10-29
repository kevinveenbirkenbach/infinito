<?php

namespace tests\unit\Entity\Source;

use App\Entity\Source\GroupSourceInterface;
use App\Entity\Source\GroupSource;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 */
class GroupSourceTest extends TestCase
{
    /**
     * @var GroupSourceInterface
     */
    protected $groupSource;

    public function setUp(): void
    {
        $this->groupSource = new GroupSource();
    }

    public function testMembers()
    {
        $this->assertInstanceOf(Collection::class, $this->groupSource->getMembers());
        $member = new class() extends AbstractSource {
        };
        $this->groupSource->setMembers(new ArrayCollection([$member]));
        $this->assertEquals($member, $this->groupSource->getMembers()->get(0));
    }
}
