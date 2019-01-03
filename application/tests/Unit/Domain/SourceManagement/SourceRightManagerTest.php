<?php

namespace Unit\Domain\SourceManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceRightManagerInterface;
use App\Entity\Source\AbstractSource;
use App\Domain\SourceManagement\SourceRightManager;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\Entity\Meta\Law;
use App\Exception\AllreadySetException;
use App\Exception\NotSetException;
use App\Exception\AllreadyDefinedException;

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

    private function createSourceMock()
    {
        return new class() extends AbstractSource {
        };
    }

    public function setUp(): void
    {
        $this->source = $this->createSourceMock();
        $this->sourceRightManager = new SourceRightManager($this->source);
        $this->right = new Right();
    }

    public function testLawException(): void
    {
        $this->right->setLaw(new Law());
        $this->expectException(AllreadyDefinedException::class);
        $this->sourceRightManager->addRight($this->right);
    }

    public function testSourceException(): void
    {
        $this->right->setSource($this->createSourceMock());
        $this->expectException(AllreadyDefinedException::class);
        $this->sourceRightManager->addRight($this->right);
    }

    public function testNotSetException(): void
    {
        $this->expectException(NotSetException::class);
        $this->sourceRightManager->removeRight($this->right);
    }

    public function testAllreadSetException(): void
    {
        $this->sourceRightManager->addRight($this->right);
        $this->expectException(AllreadySetException::class);
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
