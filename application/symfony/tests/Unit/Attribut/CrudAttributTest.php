<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\CrudAttributInterface;
use Infinito\Attribut\CrudAttribut;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Exception\NoValidChoiceException;

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
        foreach (CRUDType::getChoices() as $enum) {
            $this->assertNull($this->crudAttribut->setCrud($enum));
            $this->assertEquals($enum, $this->crudAttribut->getCrud());
        }
        $this->expectException(NoValidChoiceException::class);
        $this->crudAttribut->setCrud('NoneValidType');
    }
}
