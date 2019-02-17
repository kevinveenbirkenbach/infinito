<?php

namespace tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Meta\Law;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Exception\NoValidChoiceException;
use Infinito\Entity\Source\AbstractSource;

/**
 * @todo Implement reciever test
 *
 * @author kevinfrantz
 */
class RightTest extends TestCase
{
    /**
     * @var RightInterface
     */
    private $right;

    public function setUp(): void
    {
        $this->right = new Right();
    }

    public function testConstructorGeneral(): void
    {
        $this->assertTrue($this->right->getGrant());
        $this->assertEquals(0, $this->right->getPriority());
    }

    public function testConstructorReciever(): void
    {
        $this->expectException(\TypeError::class);
        $this->right->getReciever();
    }

    public function testConstructorLayer(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getLayer());
    }

    public function testConstructorLaw(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getLaw());
    }

    public function testConstructorCondition(): void
    {
        $this->expectException(\TypeError::class);
        $this->right->getCondition();
    }

    public function testConstructorType(): void
    {
        $this->expectException(\TypeError::class);
        $this->assertNull($this->right->getCrud());
    }

    public function testLaw(): void
    {
        $law = new Law();
        $this->assertNull($this->right->setLaw($law));
        $this->assertEquals($law, $this->right->getLaw());
    }

    public function testRight(): void
    {
        foreach (CRUDType::getChoices() as $enum) {
            $this->assertNull($this->right->setCrud($enum));
            $this->assertEquals($enum, $this->right->getCrud());
        }
        $this->expectException(NoValidChoiceException::class);
        $this->right->setCrud('NoneValidType');
    }

    public function testLayer(): void
    {
        foreach (LayerType::getChoices() as $choice) {
            $this->assertNull($this->right->setLayer($choice));
            $this->assertEquals($choice, $this->right->getLayer());
        }
        $this->expectException(NoValidChoiceException::class);
        $this->right->setLayer('NoneValidLayer');
    }

    /**
     * Just to test if the clone function works like assumed.
     */
    public function testClone(): void
    {
        $source = $this->createMock(AbstractSource::class);
        $reciever = $this->createMock(AbstractSource::class);
        $grant = false;
        $type = CRUDType::READ;
        $layer = LayerType::SOURCE;
        $this->right->setSource($source);
        $this->right->setReciever($reciever);
        $this->right->setGrant($grant);
        $this->right->setCrud($type);
        $this->right->setLayer($layer);
        $rightClone = clone $this->right;
        $this->assertEquals($source, $rightClone->getSource());
        $this->assertEquals($reciever, $rightClone->getReciever());
        $this->assertEquals($grant, $rightClone->getGrant());
        $this->assertEquals($type, $rightClone->getCrud());
        $this->assertEquals($layer, $rightClone->getLayer());
    }
}
