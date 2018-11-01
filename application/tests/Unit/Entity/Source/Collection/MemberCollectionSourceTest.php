<?php
namespace Tests\Unit\Entity\Source\Collection;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\AbstractSource;
use App\Entity\Source\Collection\MemberCollectionSourceInterface;
use App\Entity\Source\Collection\MemberCollectionSource;

/**
 *
 * @author kevinfrantz
 */
class MemberCollectionSourceTest extends TestCase
{

    /**
     *
     * @var MemberCollectionSourceInterface
     */
    protected $groupSource;

    public function setUp(): void
    {
        $this->groupSource = new MemberCollectionSource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->groupSource->getMembers());
    }

    public function testMembers()
    {
        $member = new class() extends AbstractSource {};
        $this->groupSource->setMembers(new ArrayCollection([
            $member
        ]));
        $this->assertEquals($member, $this->groupSource->getMembers()
            ->get(0));
    }
}
