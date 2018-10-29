<?php

namespace tests\unit\Entity\Source;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Entity\Meta\LawInterface;
use App\Entity\Meta\RelationInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 */
class AbstractSourceTest extends TestCase
{
    const ID = 123;
    /**
     * @var SourceInterface
     */
    protected $source;

    public function setUp()
    {
        $this->source = new class() extends \App\Entity\Source\AbstractSource {
        };
        $this->source->setId(self::ID);
    }

    public function testId()
    {
        $this->assertEquals($this->source->getId(), self::ID);
    }

    public function testLaw()
    {
        $this->assertInstanceOf(LawInterface::class, $this->source->getLaw());
    }

    public function testRelation()
    {
        $this->assertInstanceOf(RelationInterface::class, $this->source->getRelation());
    }

    public function testGroups()
    {
        $this->assertInstanceOf(Collection::class, $this->source->getGroupSources());
        $group = new class() extends AbstractSource {
        };
        $groups = new ArrayCollection([$group]);
        $this->source->setGroupSources($groups);
        $this->assertEquals($group, $this->source->getGroupSources()->get(0));
    }
}
