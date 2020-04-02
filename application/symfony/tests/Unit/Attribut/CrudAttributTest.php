<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\CrudAttribut;
use Infinito\Attribut\CrudAttributInterface;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Exception\Type\InvalidChoiceTypeException;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class CrudAttributTest extends TestCase
{
    /**
     * @var CrudAttributInterface
     */
    protected $crudAttribut;

    public function setUp(): void
    {
        $this->crudAttribut = new class() implements CrudAttributInterface {
            use CrudAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->crudAttribut->getCrud();
    }

    public function testAccessors(): void
    {
        foreach (CRUDType::getValues() as $enum) {
            $this->assertNull($this->crudAttribut->setCrud($enum));
            $this->assertEquals($enum, $this->crudAttribut->getCrud());
        }
        $this->expectException(InvalidChoiceTypeException::class);
        $this->crudAttribut->setCrud('NoneValidType');
    }
}
