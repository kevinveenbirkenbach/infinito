<?php

namespace Unit\Domain\Source;

use Infinito\Domain\Source\SourceRightManager;
use Infinito\Domain\Source\SourceRightManagerInterface;
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Source\PureSource;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Exception\Attribut\AllreadyDefinedAttributException;
use Infinito\Exception\Collection\ContainsElementException;
use Infinito\Exception\Collection\NotSetElementException;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class SourceRightManagerTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var SourceRightManagerInterface
     */
    private $sourceRightManager;

    /**
     * @var RightInterface
     */
    private $right;

    public function setUp(): void
    {
        $this->source = new PureSource();
        $this->sourceRightManager = new SourceRightManager($this->source);
        $this->right = new Right();
    }

    public function testLawException(): void
    {
        $this->right->setLaw(new Law());
        $this->expectException(AllreadyDefinedAttributException::class);
        $this->sourceRightManager->addRight($this->right);
    }

    public function testSourceException(): void
    {
        $this->right->setSource(new PureSource());
        $this->expectException(AllreadyDefinedAttributException::class);
        $this->sourceRightManager->addRight($this->right);
    }

    public function testNotSetElementException(): void
    {
        $this->expectException(NotSetElementException::class);
        $this->sourceRightManager->removeRight($this->right);
    }

    public function testAllreadSetException(): void
    {
        $this->sourceRightManager->addRight($this->right);
        $this->expectException(ContainsElementException::class);
        $this->sourceRightManager->addRight($this->right);
    }

    public function testRightAdd(): void
    {
        $this->assertNull($this->sourceRightManager->addRight($this->right));
        $this->assertEquals($this->source, $this->right->getSource());
        $this->assertEquals($this->right, $this->source->getLaw()->getRights()->get(0));
        $this->assertEquals($this->right->getLaw(), $this->source->getLaw());
        $this->assertNull($this->sourceRightManager->removeRight($this->right));
        $this->assertNotEquals($this->source, $this->right->getSource());
        $this->assertNotEquals($this->right->getLaw(), $this->source->getLaw());
        $this->assertEquals(0, $this->source->getLaw()->getRights()->count());
    }
}
