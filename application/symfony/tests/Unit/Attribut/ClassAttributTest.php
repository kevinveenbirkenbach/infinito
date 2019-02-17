<?php

namespace Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\ClassAttributInterface;
use Infinito\Attribut\ClassAttribut;
use Infinito\Entity\Source\AbstractSource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassAttributTest extends TestCase
{
    /**
     * @var ClassAttributInterface
     */
    protected $classAttribut;

    public function setUp(): void
    {
        $this->classAttribut = new class() implements ClassAttributInterface {
            use ClassAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->assertFalse($this->classAttribut->hasClass());
        $this->expectException(\TypeError::class);
        $this->classAttribut->getClass();
    }

    public function testAccessors(): void
    {
        $class = AbstractSource::class;
        $this->assertNull($this->classAttribut->setClass($class));
        $this->assertTrue($this->classAttribut->hasClass());
        $this->assertEquals($class, $this->classAttribut->getClass());
    }

    public function testException(): void
    {
        $class = 'NOTEXISTINGCLASS';
        $this->expectException(NotFoundHttpException::class);
        $this->classAttribut->setClass($class);
    }
}
