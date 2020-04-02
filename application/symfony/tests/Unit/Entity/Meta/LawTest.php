<?php

namespace tests\unit\Entity\Meta;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Meta\LawInterface;
use Infinito\Entity\Meta\Right;
use PHPUnit\Framework\TestCase;

class LawTest extends TestCase
{
    /**
     * @var LawInterface
     */
    protected $law;

    public function setUp(): void
    {
        $this->law = new Law();
    }

    public function testConstruct(): void
    {
        $this->assertFalse($this->law->getGrant());
        $this->assertInstanceOf(Collection::class, $this->law->getRights());
    }

    public function testRights(): void
    {
        $right = new Right();
        $rights = new ArrayCollection([$right, new Right(), new Right()]);
        $this->assertNull($this->law->setRights($rights));
        $this->assertEquals($right, $this->law->getRights()->get(0));
    }

    /**
     * Implemented to debug where ReflectionException "Property Infinito\\Entity\\Meta\\Law::$relation does not exist" is coming from.
     */
    public function testRelationNotSet(): void
    {
        $reflectionClass = new \ReflectionClass($this->law);
        $this->assertFalse($reflectionClass->hasMethod('getRelation'));
        $this->assertFalse($reflectionClass->hasMethod('setRelation'));
        $this->assertFalse($reflectionClass->hasProperty('relation'));
    }
}
